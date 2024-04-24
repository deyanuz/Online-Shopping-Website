<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;

class AdminHomeSliderController extends Controller
{
    public function index(){
        $slides= HomeSlider::orderBy("created_at","desc")->get();
        return view("auth.homeSlider",["slides"=>$slides]);
    }
}
