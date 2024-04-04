<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::content();
        return view("frontend.cart", ["cartItems" => $cartItems]);
    }
    public function store($id)
    {
        $product = Product::where("id", $id)->first();
        Cart::add($product->id, $product->name, 1, $product->regular_price)->associate('App\Models\Product');
        return redirect()->route('frontend.cart')->with('success', 'Item added successfully');
    }
    public function increaseQuantity($id, $qty)
    {
        $product = Product::where("id", $id)->first();
        if ($product->quantity > $qty) {
            Cart::add($product->id, $product->name, 1, $product->regular_price)->associate('App\Models\Product');
            return redirect()->route('frontend.cart');
        }
        return redirect()->route('frontend.cart')->with('error', 'Maximum limit reached');
    }
    public function decreaseQuantity($id, $qty)
    {
        $product = Product::where("id", $id)->first();
        if ($qty > 1) {
            Cart::add($product->id, $product->name, -1, $product->regular_price)->associate('App\Models\Product');
            return redirect()->route('frontend.cart');
        } elseif ($qty <= 1) {
            $cart = Cart::content()->where('id', $id)->first();
            $rowId = $cart->rowId;
            Cart::remove($rowId);
        }

        return redirect()->route('frontend.cart');
    }
    public function delete($id)
    {
        $cart = Cart::content()->where('id', $id)->first();
        $rowId = $cart->rowId;
        if ($rowId) {
            Cart::remove($rowId);
            session()->flash('success', 'Item removed successfully');
        }

        return redirect()->route('frontend.cart');
    }
}
