<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class AddCategoryController extends Controller
{
    public function storeCategory(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $category = new Category();
        $category->name = $validatedData["name"];
        $category->slug = Str::slug($validatedData["slug"]);
        $category->save();
        return redirect()->route("admin.addCategory")->with("success","Category Added Successfully!");

    }
    public function index(){
        return view("auth.addCategory");
    }
}
