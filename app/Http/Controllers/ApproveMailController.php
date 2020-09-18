<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;
use App\Orders;

class ApproveMailController extends Controller
{
    public function approve(Request $request, Orders $order) {
        $data = $order->id;
        // dd($data);
        Mail::to('ash@gmail.com')->send(new EmailVerification($data));

        return redirect('/order/index')->with("email_success", "Mail Sent to user");
    }
}