<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class DetailsController extends Controller
{
    public $slug;
    public function __construct(Request $request)
    {
        $this->slug = $request->route('slug');
    }
    public function index(){
        $product = Product::where("slug", $this->slug)->first();
        $categories = Category::orderBy('name', "ASC")->get();
        $rproduct=Product::where("category_id", $product->category_id)->inRandomOrder()->limit(4)->get();
        $nproducts=Product::latest()->take(4)->get();
        return view("frontend.details", ["product" => $product,"rproducts"=> $rproduct,"nproducts"=> $nproducts, "categories" => $categories]);
    }
    public function store($id)
    {
        $product = Product::where("id", $id)->first();
        Cart::instance('cart')->add($product->id, $product->name, 1, $product->regular_price)->associate('App\Models\Product');
        return redirect()->route('frontend.shop')->with('success', 'Item added successfully');
    }
}
