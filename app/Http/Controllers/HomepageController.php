<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view("home", ["products" => $products]);
    }
}
