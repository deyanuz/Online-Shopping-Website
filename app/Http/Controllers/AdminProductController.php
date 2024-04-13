<?php

namespace App\Http\Controllers;

use App\Models\Product;
class AdminProductController extends Controller
{
    public function index(){
        $products = Product::orderBy("created_at","desc")->paginate(7);
        return view("auth.productPage",["products"=>$products]);
    }
}
