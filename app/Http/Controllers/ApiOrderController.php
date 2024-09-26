<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('Orderrow')->get();
        return $orders;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('Orderrow')->find($id);
        return $order;
    }
}
