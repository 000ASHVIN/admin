<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

use Config;

class PaypalClient extends Controller
{
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    public static function environment()
    {
        $paypalConfig = Config::get('paypal');
        $clientId = $paypalConfig['client_id'];
        $clientSecret = $paypalConfig['secret'];
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}
