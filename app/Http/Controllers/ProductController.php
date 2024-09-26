<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view("products.index", ["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "api_id" => "required|integer|unique:products",
            "name" => "required|string|max:255",
            "description" => "required|string",
            "price" => "required",
            "image" => "required",
            "color" => "required|string|max:255",
            "height_cm" => "required|string|max:5",
            "width_cm" => "required|string|max:5",
            "depth_cm" => "required|string|max:5",
            "weight_gr" => "required|string|max:10",
        ]);        

        $newProduct = new Product();
        $newProduct->api_id = $validatedData["api_id"];
        $newProduct->name = $validatedData["name"];
        $newProduct->description = $validatedData["description"];
        $newProduct->price = $validatedData["price"];
        $newProduct->img_src = $validatedData["image"];
        $newProduct->color = $validatedData["color"];
        $newProduct->height_cm = $validatedData["height_cm"];
        $newProduct->width_cm = $validatedData["width_cm"];
        $newProduct->depth_cm = $validatedData["depth_cm"];
        $newProduct->weight_gr = $validatedData["weight_gr"];
        $newProduct->created_at = Carbon::now();
        $newProduct->updated_at = Carbon::now();

        $newProduct->save();

        $product = Product::find($newProduct->id);
        $categorie = Categorie::find($product->categorie_id);

        // Add the first to letters of the products categorie to the SKU
        $SKU = strtoupper($categorie->name[0] . $categorie->name[1]);

        // Add the first to letters of the products name to the SKU
        $SKU = $SKU . strtoupper($product->name[0] . $product->name[1]);

        // Add the id of the product to the back of the SKU
        $numberOfCharacters = strlen($SKU) + strlen($product->id);
        
        if ($numberOfCharacters < 15) {
            for ($i=0; $i < (15 - $numberOfCharacters); $i++) { 
                $SKU = $SKU . '0';
            }
            $SKU = $SKU . $product->id;
        } else {
            $SKU = $SKU . $product->id;
        }

        $product->stock_keeping_unit = $SKU;
        $product->save();

        return redirect()->route("management.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Categorie::all();

        return view("products.edit", [
            "product" => $product,
            "categories" => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string",
            "price" => "required",
            "categorie_id" => "required|integer",
            "color" => "required|string|max:255",
            "height_cm" => "required|string|max:5",
            "width_cm" => "required|string|max:5",
            "depth_cm" => "required|string|max:5",
            "weight_gr" => "required|string|max:10",
        ]);

        $product = Product::findOrFail($id);
        $categorie = Categorie::find($request->categorie_id);

        // Add the categorie name to the SKU
        $SKU = strtoupper($categorie->name[0] . $categorie->name[1]);
        // Add the product name to the SKU
        $SKU = $SKU . strtoupper($request->name[0] . $request->name[1]);
        // Add the id of the product to the back of the SKU
        $numberOfCharacters = strlen($SKU) + strlen($product->id);
        if ($numberOfCharacters < 15) {
            for ($i=0; $i < (15 - $numberOfCharacters); $i++) { 
                $SKU = $SKU . '0';
            }
            $SKU = $SKU . $product->id;
        } else {
            $SKU = $SKU . $product->id;
        }

        if ($request->file("image") != null) {
            Storage::disk("public")->put("products", $request->file("image"));

            $product->update([
                "stock_keeping_unit" => $SKU,
                "name" => $request->input("name"),
                "description" => $request->input("description"),
                "price" => $request->input("price"),
                "img_src" =>
                    "storage/products/" . $request->file("image")->hashName(),
                "categorie_id" => $request->categorie_id,
                "color" => $request->input("color"),
                "height_cm" => $request->input("height_cm"),
                "width_cm" => $request->input("width_cm"),
                "depth_cm" => $request->input("depth_cm"),
                "weight_gr" => $request->input("weight_gr"),
                "updated_at" => Carbon::now(),
            ]);
        } else {
            $product->update([
                "stock_keeping_unit" => $SKU,
                "name" => $request->input("name"),
                "description" => $request->input("description"),
                "price" => $request->input("price"),
                "categorie_id" => $request->categorie_id,
                "color" => $request->input("color"),
                "height_cm" => $request->input("height_cm"),
                "width_cm" => $request->input("width_cm"),
                "depth_cm" => $request->input("depth_cm"),
                "weight_gr" => $request->input("weight_gr"),
                "updated_at" => Carbon::now(),
            ]);    
        }

        $product->save();

        return redirect()->route("products.edit", ["product" => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()
            ->route("products.index")
            ->with("succes", "Product Succesfully deleted");
    }
}
