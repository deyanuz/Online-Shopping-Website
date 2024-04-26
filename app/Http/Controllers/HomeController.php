<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HomeSlider::where('status', 1)->get();
        $lproducts = Product::orderBy('created_at', 'desc')->get()->take(8);
        return view("frontend.home", ["slides" => $slides, "lproducts" => $lproducts]);
    }
}
