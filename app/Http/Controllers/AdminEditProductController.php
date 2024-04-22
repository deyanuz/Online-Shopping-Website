<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
class AdminEditProductController extends Controller
{
    public function updateProduct(Request $request, $id)
    {
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

        $slug = Str::slug($validatedData['slug']);


        $product = Product::find($id);

        if($request->hasFile('image')) {
            unlink(public_path("assets/imgs/products/". $product->image ));
            $imageName = Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('products',$imageName);
            }

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
    public function index($id){
        $product = Product::find($id);
        $categories = Category::orderBy("name", "asc")->get();
        return view("auth.editProduct", ["categories" => $categories,"product"=> $product,"id"=> $id]);
    }
}
