<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;
use Cart;

class ShopController extends Controller
{

    public function index(Request $request)
    {
        $orderBy = Session::get('orderBy', 'Default Sorting');
        $pageSize = Session::get('pageSize', 12);
        $from  =$request->price1? $request->price1:0;
        $max=Product::max('regular_price');
        $to  = $request->price2? $request->price2:$max;
        if ($orderBy === 'Price: Low to High') {
            $products = Product::whereBetween('regular_price', [$from, $to])->with('category')->orderBy('regular_price', "ASC")->paginate((int)$pageSize);
        } else if ($orderBy === 'Price: High to Low') {
            $products = Product::whereBetween('regular_price', [$from, $to])->with('category')->orderBy('regular_price', "DESC")->paginate((int)$pageSize);
        } else if ($orderBy === 'Newest Arrivals') {
            $products = Product::whereBetween('regular_price', [$from, $to])->with('category')->orderBy('created_at', "DESC")->paginate((int)$pageSize);
        } else {
            $products = Product::whereBetween('regular_price', [$from, $to])->with("category")->paginate((int)$pageSize);
        }

        $nproducts = Product::latest()->take(4)->get();
        $categories = Category::orderBy('name', "ASC")->get();
        return view("frontend.shop", ["products" => $products, "nproducts" => $nproducts, "size" => $pageSize, "orderBy" => $orderBy, "categories" => $categories, "from" => $from, "to" => $to]);
    }
    public function addToWishlist($id)
    {
        $product = Product::where("id", $id)->first();
        Cart::instance('wishlist')->add($product->id, $product->name, 1, $product->regular_price)->associate('App\Models\Product');
        return redirect()->route('frontend.shop');
    }

    public function changeOrderBy($orderBy)
    {
        Session::put('orderBy', $orderBy);
        return redirect()->route('frontend.shop');
    }
    public function changePageSize($size)
    {

        Session::put('pageSize', $size);
        return redirect()->route('frontend.shop');
    }
    public function setPriceRange(Request $request)
    {
        Session::put('from', $request->input('from'));
        Session::put('to', $request->input('to'));
        return redirect()->route('frontend.shop');
    }
    public function remove($id)
    {
        $cartItem = Cart::instance('wishlist')->content()->where('id', $id)->first();
        $rowId = $cartItem->rowId;
        if ($rowId) {
            Cart::instance('wishlist')->remove($rowId);
        }

        return redirect()->route('frontend.shop');
    }
}
