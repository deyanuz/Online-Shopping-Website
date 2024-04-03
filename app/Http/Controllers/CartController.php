<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::instance('cart')->content();
        return view("frontend.cart", ["cartItems" => $cartItems]);
    }
    public function store($id)
    {
        $product = Product::where("id", $id)->first();
        Cart::instance('cart')->add($product->id, $product->name, 1, $product->regular_price)->associate('App\Models\Product');
        return redirect()->route('frontend.cart')->with('success', 'Item added successfully');
    }
    public function updateQuantity(Request $request)
    {
        Cart::instance('cart')->update($request->id, $request->quantity);
        return redirect()->route('frontend.cart')->with('success', 'Item added successfully');
    }
}
