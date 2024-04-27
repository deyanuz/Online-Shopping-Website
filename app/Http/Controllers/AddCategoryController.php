<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AddCategoryController extends Controller
{
    public function storeCategory(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'is_popular' => 'required',
        ]);
        $category = new Category();
        $category->name = $validatedData["name"];
        $category->slug = Str::slug($validatedData["slug"]);
        $category->is_popular = $validatedData["is_popular"];

        $imageName = Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('categories',$imageName);
        $category->image = $imageName;
        $category->save();
        return redirect()->route("admin.addCategory")->with("success","Category Added Successfully!");

    }
    public function index(){
        return view("auth.addCategory");
    }
}
