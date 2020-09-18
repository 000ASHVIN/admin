<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\WebProfile;
use PayPal\Api\ItemList;
use PayPal\Api\InputFields;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use App\Invoice;
use App\Orders;
use App\Suborders;
use App\CartItem;
use Str;
Use Request;
use Auth;
use Config;
use App\Exceptions;
use App\Http\Controllers\PayPalClient;

class PaypalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        # Main configuration in constructor
        $paypalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret'])
        );

        $this->apiContext->setConfig($paypalConfig['settings']);
    }

    public function index()
    {
        return view('store.index');
    }

    public function payWithpaypal(Request $request)
    {
        # We initialize the payer object and set the payment method to PayPal
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        $client = PayPalClient::client();

        # We insert a new order in the order table with the 'initialised' status
        $order = new Orders();
        $order->user_id = Auth::user()->id;
        $order->invoice_id = null;
        $order->status = 'initialised';
        $order->save();

        # We need to update the order if the payment is complete, so we save it to the session
        Session::put('orderId', $order->getKey());

        # We get all the items from the cart and parse the array into the Item object
        $items = [];

        foreach (CartItem::all() as $item) {
            // dd($item);
            $items[] = (new Item())
                ->setName($item->products->product_name)
                ->setCurrency('USD')
                ->setQuantity($item->quantity)
                ->setPrice($item->products->product_price);
        }

        # We create a new item list and assign the items to it
        $itemList = new ItemList();
        $itemList->setItems($items);
        // dd($itemList);

        # Disable all irrelevant PayPal aspects in payment
        $inputFields = new InputFields();
        $inputFields->setAllowNote(true)
            ->setNoShipping(1)
            ->setAddressOverride(0);
            

        $webProfile = new WebProfile();
        $webProfile->setName(uniqid())
            ->setInputFields($inputFields)
            ->setTemporary(true);
            
        $createProfile = $webProfile->create($this->apiContext);

        # We get the total price of the cart
        $amount = new Amount();
        $totalAmount = 0;
        foreach (CartItem::all() as $item) {
            // dd($item);
            $totalAmount += $item->quantity * $item->products->product_price;
        }
        // dd($totalAmount);
        $amount->setCurrency('USD')
            ->setTotal($totalAmount);
        // dd($amount);
            
        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList)
            ->setDescription('Your transaction description');

        $redirectURLs = new RedirectUrls();
        $redirectURLs->setReturnUrl(URL::to('status'))
            ->setCancelUrl(URL::to('status'));

            

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectURLs)
            ->setTransactions(array($transaction));
            
        $payment->setExperienceProfileId($createProfile->getId());
        // $payment->create($this->apiContext);
        // dd($payment);
        try {
            $payment->create($this->apiContext);
            // dd($payment);
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode(); // Prints the Error Code
            echo $ex->getData(); // Prints the detailed error message 
            die($ex);
        } catch (Exceptions $ex) {
            die($ex);
        }


        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectURL = $link->getHref();
                break;
            }
        }

        # We store the payment ID into the session
        Session::put('paypalPaymentId', $payment->getId());

        if (isset($redirectURL)) {
            return Redirect::away($redirectURL);
        }

        Session::put('error', 'There was a problem processing your payment. Please contact support.');

        return Redirect::to('/cartitem');
    }

    public function getPaymentStatus()
    {
        $paymentId = Session::get('paypalPaymentId');
        $orderId = Session::get('orderId');

        # We now erase the payment ID from the session to avoid fraud
        Session::forget('paypalPaymentId');

        # If the payer ID or token isn't set, there was a corrupt response and instantly abort
        if (empty(Request::get('PayerID')) || empty(Request::get('token'))) {
            Session::put('error', 'There was a problem processing your payment. Please contact support.');
            return Redirect::to('/cartitem');
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(Request::get('PayerID'));

        $result = $payment->execute($execution, $this->apiContext);

        # Payment is processing but may still fail due e.g to insufficient funds
        $order = Orders::find($orderId);
        $order->status = 'processing';

        if ($result->getState() == 'approved') {

            $invoice = new Invoice();
            $invoice->price = $result->transactions[0]->getAmount()->getTotal();
            $invoice->currency = $result->transactions[0]->getAmount()->getCurrency();
            $invoice->customer_email = $result->getPayer()->getPayerInfo()->getEmail();
            $invoice->customer_id = $result->getPayer()->getPayerInfo()->getPayerId();
            $invoice->country_code = $result->getPayer()->getPayerInfo()->getCountryCode();
            $invoice->payment_id = $result->getId();

            # We update the invoice status
            $invoice->payment_status = 'approved';
            $invoice->save();

            # We also update the order status
            $order->invoice_id = $invoice->getKey();
            $order->status = 'pending';
            $order->save();

            # We insert the suborder (products) into the table
            foreach (CartItem::all() as $item) {
                $suborder = new Suborders();
                $suborder->orders_id = $orderId;
                $suborder->products_id = $item->products_id;
                $suborder->price = $item->price;
                $suborder->quantity = $item->quantity;
                $suborder->save();
            }

            foreach (CartItem::all() as $item) {
                $item->delete();
            }
            // CartItem::destroy();

            Session::put('success', 'Your payment was successful. Thank you.');

            return Redirect::to('/cartitem');
        }

        Session::put('error', 'There was a problem processing your payment. Please contact support.');

        return Redirect::to('/cartitem');
    }
}