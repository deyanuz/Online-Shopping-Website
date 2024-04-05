<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;
class ShopController extends Controller
{
    public function index()
    {
        $pageSize = Session::get('pageSize', 12);
        $orderBy=Session::get('orderBy', 'Default Sorting');
        if($orderBy=='Price: Low to High'){
            $products = Product::with('category')->orderBy('regular_price',"ASC")->paginate($pageSize);
        }
        else if($orderBy=='Price: High to Low'){
            $products = Product::with('category')->orderBy('regular_price',"DESC")->paginate($pageSize);
        }
        else if($orderBy=='Newest Arrivals'){
            $products = Product::with('category')->orderBy('created_at',"DESC")->paginate($pageSize);
        }
        else{
            $products = Product::with("category")->paginate($pageSize);
        }

        $nproducts = Product::latest()->take(4)->get();
        return view("frontend.shop", ["products" => $products, "nproducts" => $nproducts,"size"=> $pageSize]);
    }

    public function changeOrderBy($orderBy){
        Session::put('orderBy', $orderBy);;
        return redirect()->route('frontend.shop');
    }
    public function changePageSize($size){

        Session::put('pageSize', $size);
        return redirect()->route('frontend.shop');
    }

}
