<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminAddProductController extends Controller
{

    public function storeProduct(Request $request)
    {
        //dd($request->all());
         $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'regular_price' => 'required',
            'sale_price' => 'nullable',
            'sku' => 'required|string|max:255',
            'stock_status' => 'required|string',
            'featured' => 'required',
            'quantity' => 'required|integer|min:0',
            'image' => 'required',
            'category' => 'required',
         ]);

        // // Sanitize slug
        $slug = Str::slug($validatedData['slug']);

        // // Store the image
        $imageName = Carbon::now()->timestamp . '.' . $request->file('image')->Extension();
        $request->file('image')->storeAs('products', $imageName);

        // // Create and save the product
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->regular_price = $validatedData['regular_price'];
        $product->sku = $validatedData['sku'];
        $product->short_description = $validatedData['short_description'];
        $product->description = $validatedData['description'];
        $product->sale_price = $validatedData['sale_price'];
        $product->stock_status = $validatedData['stock_status'];
        $product->featured = $validatedData['featured'];
        $product->quantity = $validatedData['quantity'];
        $product->category_id = $validatedData['category'];
        $product->slug = $slug;
        $product->image = $imageName;
        $product->save();

        return redirect()->route("admin.addProduct")->with("success", "Product Added Successfully!");
    }

    public function index()
    {
        $categories = Category::orderBy("name", "asc")->get();
        return view("auth.addProduct", ["categories" => $categories]);
    }
}
