<?php

namespace App\Http\Controllers;

use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy("name","asc")->paginate(5);
        return view("auth.categoryPage",["categories"=>$categories]);
    }
}
