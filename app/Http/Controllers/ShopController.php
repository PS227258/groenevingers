<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(15);

        return view("shop.index", compact("products"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        return view("shop.show", ["product" => $product]);
    }
}
