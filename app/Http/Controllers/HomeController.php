<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $slides =HomeSlider::where('status',1)->get();
        return view("frontend.home",["slides"=>$slides]);
    }
}
