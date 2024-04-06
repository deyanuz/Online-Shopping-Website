<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class ProductByCategory extends Controller
{
    public function index($slug)
    {
        $orderBy = Session::get('orderBy', 'Default Sorting');
        $pageSize = Session::get('pageSize', 12);
        $category = Category::where('slug',$slug)->first();

        if ($orderBy === 'Price: Low to High') {
            $products = Product::where('category_id',$category->id)->with('category')->orderBy('regular_price', "ASC")->paginate((int)$pageSize);
        } else if ($orderBy === 'Price: High to Low') {
            $products = Product::where('category_id',$category->id)->with('category')->orderBy('regular_price', "DESC")->paginate((int)$pageSize);
        } else if ($orderBy === 'Newest Arrivals') {
            $products = Product::where('category_id',$category->id)->with('category')->orderBy('created_at', "DESC")->paginate((int)$pageSize);
        } else {
            $products = Product::where('category_id',$category->id)->with("category")->paginate((int)$pageSize);
        }

        $nproducts = Product::latest()->take(4)->get();
        $categories = Category::orderBy('name', "ASC")->get();
        return view("frontend.productByCategory", ["products" => $products, "nproducts" => $nproducts, "size" => $pageSize, "orderBy" => $orderBy, "categories" => $categories]);
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
