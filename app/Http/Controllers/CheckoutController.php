<?php

namespace App\Http\Controllers;

use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cookie = request()->cookie('order_id');
        $order = Order::with('Orderrow')->find($cookie);

        return view('checkout', ['order' => $order]);
    }
}
