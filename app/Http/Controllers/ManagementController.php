<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::withToken("50|Oy8mM3g2A8jSTpiHoxrRXXdspGlvQHbbQ45qM272")->get("https://kuin.summaict.nl/api/product");
        $response = $response->json();

        return view('management.index', ["products" => $response]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $products = Http::withToken("50|Oy8mM3g2A8jSTpiHoxrRXXdspGlvQHbbQ45qM272")->get("https://kuin.summaict.nl/api/product");
        $products = $products->json();
        
        if ($request->order_id !== null) {
            $order = Http::withToken("50|Oy8mM3g2A8jSTpiHoxrRXXdspGlvQHbbQ45qM272")->get("https://kuin.summaict.nl/api/orderItem?order_id=" . $request->order_id);
            $order = $order->json();

            $order_id = $order[0]["order_id"];

            return view('management.create', ["products" => $products, "order_id" => $order_id, "orderrows" => $order]);
        }

        return view('management.create', ["products" => $products, "order_id" => null, "orderrows" => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->order_id) {
            $response = Http::withToken("50|Oy8mM3g2A8jSTpiHoxrRXXdspGlvQHbbQ45qM272")->post("https://kuin.summaict.nl/api/orderItem?order_id=" . $request->order_id, [
                'product_id' => $request->product,
                'quantity' => $request->quantity
            ]);

            if ($response->successful()) {
                return redirect()->route('management.create', ['order_id' => $response["order_id"]]);
            }
        } else {
            $response = Http::withToken("50|Oy8mM3g2A8jSTpiHoxrRXXdspGlvQHbbQ45qM272")->post("https://kuin.summaict.nl/api/orderItem", [
                'product_id' => $request->product,
                'quantity' => $request->quantity
            ]);

            if ($response->successful()) {
                $order = $response->json();

                $products = Http::withToken("50|Oy8mM3g2A8jSTpiHoxrRXXdspGlvQHbbQ45qM272")->get("https://kuin.summaict.nl/api/product");
                $products = $products->json();

                return redirect()->route('management.create', ['products' => $products, 'order_id' => $order["order_id"], "orderrows" => $order]);
            }
        }

        return redirect()->route('management.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::withToken("50|Oy8mM3g2A8jSTpiHoxrRXXdspGlvQHbbQ45qM272")->get("https://kuin.summaict.nl/api/product/" . $id);

        return view('management.show', ["product" => $response]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = Http::withToken("50|Oy8mM3g2A8jSTpiHoxrRXXdspGlvQHbbQ45qM272")->get("https://kuin.summaict.nl/api/orderItem?order_id=" . $id);
        
        $orderrows = $response->json();
        
        for ($i=0; $i < count($orderrows); $i++) {
            $product = Product::where('api_id', $orderrows[$i]["product_id"])->first();

            if ($product !== null) {
                $product->supply = $product->supply + $orderrows[$i]["quantity"];
                $product->save();
            } else {
                return response()->json(['error' => 'Product not found in database. Make sure to add it first'], 404);
            }
        }

        return redirect()->route('management.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
