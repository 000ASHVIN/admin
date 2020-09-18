<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Orders;

class OrderSortByDate extends Controller
{
    public function today()
    {
        // dd(Carbon::today()->toDateString());
        
        $orderPaginate = Orders::where('created_at', '>=', Carbon::today()->toDateString())->paginate(4);
        $orderArray = [];

        foreach($orderPaginate as $order) {
            $orderArray[] = Orders::find($order->id);
        }

        $orders = $orderArray;
        $today = 'today';
        return view('dashboard.order.order', compact('orders', 'today', 'orderPaginate'));
    }

    public function week()
    {
        // dd(Carbon::today()->toDateString());
        $orderPaginate = Orders::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(4);
        $orderArray = [];

        foreach($orderPaginate as $order) {
            $orderArray[] = Orders::find($order->id);
        }

        $orders = $orderArray;
        $week = 'week';
        // dd($orders);
        return view('dashboard.order.order', compact('orders', 'week', 'orderPaginate'));
    }

    public function month()
    {
        // dd(Carbon::today()->toDateString());
        $orderPaginate = Orders::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->paginate(4);
        $orderArray = [];

        foreach($orderPaginate as $order) {
            $orderArray[] = Orders::find($order->id);
        }

        $orders = $orderArray;
        $month = 'month';
        return view('dashboard.order.order', compact('orders', 'month', 'orderPaginate'));
    }

    public function year()
    {
        // dd(Carbon::today()->toDateString());
        $orderPaginate = Orders::whereYear('created_at', date('Y'))->paginate(4);
        $orderArray = [];

        foreach($orderPaginate as $order) {
            $orderArray[] = Orders::find($order->id);
        }

        $orders = $orderArray;
        $year = 'year';
        return view('dashboard.order.order', compact('orders', 'year', 'orderPaginate'));
    }

    public function sortbydate(Request $request)
    {
        $startDate = $request->get('start-date');
        $endDate = $request->get('end-date');
       
        $orderPaginate = Orders::whereBetween('created_at', [$startDate, $endDate])->paginate(4);

        $orderArray = [];

        foreach($orderPaginate as $order) {
            $orderArray[] = Orders::find($order->id);
        }

        $orders = $orderArray;

        return view('dashboard.order.order', compact('orders', 'orderPaginate'));
    }
}
