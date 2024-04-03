<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Cart;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(12);
        $nproducts = Product::latest()->take(4)->get();
        return view("frontend.shop", ["products" => $products, "nproducts" => $nproducts]);
    }
}
