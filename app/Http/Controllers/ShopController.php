<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
class ShopController extends Controller
{
    public function store($product_id,$product_name,$product_price){
        Cart::add($product_id,$product_name,1,$product_price)->associate(Product::class);
        session()->flash("success_message","Item added to cart");
        return redirect()->route('frontend.cart');
    }
    public function index(){
        $products=Product::with('category')->paginate(12);
        $nproducts=Product::latest()->take(4)->get();
        return view("frontend.shop",["products"=>$products,"nproducts"=> $nproducts]);
    }
}
