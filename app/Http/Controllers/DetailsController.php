<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public $slug;
    public function __construct(Request $request)
    {
        $this->slug = $request->route('slug');
    }
    public function index(){
        $product = Product::where("slug", $this->slug)->first();
        return view("frontend.details", ["product" => $product]);
    }
}
