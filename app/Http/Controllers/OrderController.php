<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\Suborders;
use App\Products;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{
    public function index()
    {
        $orderPaginate = DB::table('orders')->paginate(4);
        
        $orderArray = [];

        foreach($orderPaginate as $order) {
            $orderArray[] = Orders::find($order->id);
        }

        $orders = $orderArray;
        // dd($orders);
        return view('dashboard.order.order', compact('orders','orderPaginate'));
    }

    public function search(Request $request)
    {
        $username = $request->username;
        $users = User::where('username', 'LIKE', '%'.$username.'%')->get();
        // $usersPaginate = User::where('username', 'LIKE', '%'.$username.'%')->paginate(4);
        // dd($users);
        $orders = [];

        $userArray = [];

        foreach($users as $user) {
            $userArray[] = User::find($user->id);
        }

        foreach($userArray as $user) {
            foreach($user->orders()->get() as $order) {
                $orders[] = $order;
            }
        }

        $totalOrders = count($orders);
        $totalPage = intval(($totalOrders+4-1)/4);

        $orders = collect($orders)->slice(0,4);
        return view('dashboard.order.search', compact('orders', 'totalPage', 'username'));
    }

    public function searchPaginate(Request $request)
    {
        // dd($request);
        $username = $request->username;
        $users = User::where('username', 'LIKE', '%'.$username.'%')->get();

        $orders = [];

        $userArray = [];

        foreach($users as $user) {
            $userArray[] = User::find($user->id);
        }

        foreach($userArray as $user) {
            foreach($user->orders()->get() as $order) {
                $orders[] = $order;
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $perPage = 4;

        $orders = collect($orders)->slice(($currentPage * $perPage)-$perPage,$perPage);

        return view('dashboard.order.searchPaginate', compact('orders'))->render();
    }

    public function show(Orders $order)
    {
        $invoice = $order->invoice;
        $suborderPaginate = $order->suborders()->paginate(4);
        // dd($suborderPaginate);
        $products = Products::all();

        $suborderorderArray = [];

        foreach($suborderPaginate as $order) {
            $suborderorderArray[] = Suborders::find($order->id);
        }
        // dd($suborderorderArray);
        $suborders = $suborderorderArray;

        return view('/dashboard/order/show', compact('invoice', 'suborders', 'products', 'suborderPaginate'));
    }

    public function approve(Orders $order)
    {
        // dd($order);
        $order->status = 'approved';
        $order->save();

        return redirect('/order/index')->with('success', 'credentials are wrong');

    }

    public function discard(Orders $order)
    {
        // dd($order);
        $order->status = 'pending';
        $order->save();

        return redirect('/order/index')->with('success', 'credentials are wrong');

    }
}