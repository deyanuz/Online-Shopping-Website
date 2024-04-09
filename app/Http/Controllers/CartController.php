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
    public function increaseQuantity($id, $qty)
    {
        $product = Product::where("id", $id)->first();
        if ($product->quantity > $qty) {
            Cart::instance('cart')->add($product->id, $product->name, 1, $product->regular_price)->associate('App\Models\Product');
            return redirect()->route('frontend.cart');
        }
        return redirect()->route('frontend.cart')->with('error', 'Maximum limit reached');
    }
    public function decreaseQuantity($id, $qty)
    {
        $product = Product::where("id", $id)->first();
        if ($qty > 1) {
            Cart::instance('cart')->add($product->id, $product->name, -1, $product->regular_price)->associate('App\Models\Product');
            return redirect()->route('frontend.cart');
        } elseif ($qty <= 1) {
            $cart = Cart::instance('cart')->content()->where('id', $id)->first();
            $rowId = $cart->rowId;
            Cart::instance('cart')->remove($rowId);
        }

        return redirect()->route('frontend.cart');
    }
    public function delete($id)
    {
        $cart = Cart::instance('cart')->content()->where('id', $id)->first();
        $rowId = $cart->rowId;
        if ($rowId) {
            Cart::instance('cart')->remove($rowId);
            session()->flash('success', 'Item removed successfully');
        }

        return redirect()->route('frontend.cart');
    }
    public function clear()
    {
        Cart::instance('cart')->destroy();
        return redirect()->route('frontend.cart');
    }
}
