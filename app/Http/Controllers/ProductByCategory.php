<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class ProductByCategory extends Controller
{
    public function index($slug, Request $request)
    {
        $orderBy = Session::get('orderBy', 'Default Sorting');
        $pageSize = Session::get('pageSize', 12);
        $category = Category::where('slug',$slug)->first();
        $from  =$request->price1? $request->price1:0;
        $max=Product::max('regular_price');
        $to  = $request->price2? $request->price2:$max;
        if ($orderBy === 'Price: Low to High') {
            $products = Product::whereBetween('regular_price', [$from, $to])->where('category_id',$category->id)->with('category')->orderBy('regular_price', "ASC")->paginate((int)$pageSize);
        } else if ($orderBy === 'Price: High to Low') {
            $products = Product::whereBetween('regular_price', [$from, $to])->where('category_id',$category->id)->with('category')->orderBy('regular_price', "DESC")->paginate((int)$pageSize);
        } else if ($orderBy === 'Newest Arrivals') {
            $products = Product::whereBetween('regular_price', [$from, $to])->where('category_id',$category->id)->with('category')->orderBy('created_at', "DESC")->paginate((int)$pageSize);
        } else {
            $products = Product::whereBetween('regular_price', [$from, $to])->where('category_id',$category->id)->with("category")->paginate((int)$pageSize);
        }

        $nproducts = Product::latest()->take(4)->get();
        $categories = Category::orderBy('name', "ASC")->get();
        return view("frontend.productByCategory", ["products" => $products, "nproducts" => $nproducts, "size" => $pageSize, "orderBy" => $orderBy, "categories" => $categories,"category"=> $category]);
    }

    public function changeOrderBy($orderBy)
    {
        Session::put('orderBy', $orderBy);;
        return redirect()->back();
    }
    public function changePageSize($size)
    {

        Session::put('pageSize', $size);
        return redirect()->back();
    }
}
