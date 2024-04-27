<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use App\Models\Category;
class HomeController extends Controller
{
    public function index()
    {
        $slides = HomeSlider::where('status', 1)->get();
        $lproducts = Product::orderBy('created_at', 'desc')->get()->take(8);
        $fproducts=Product::where('featured',1)->inRandomOrder()->take(8)->get();
        $pcategories=Category::where('is_popular',1)->inRandomOrder()->take(8)->get();
        return view("frontend.home", ["slides" => $slides, "lproducts" => $lproducts,"fproducts"=> $fproducts,"pcategories"=> $pcategories]);
    }
}
