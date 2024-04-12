<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class EditCategoryController extends Controller
{
    public function editCategory(Request $request,$id){
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $category = Category::find($id);
        $category->name = $validatedData["name"];
        $category->slug = Str::slug($validatedData["slug"]);
        $category->save();
        return redirect()->route("admin.addCategory")->with("success","Category Updated Successfully!");
    }
    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route("admin.categories")->with("success","Category Removed Successfully!");
    }
    public function index($id){
        return view("auth.editCategory",['id'=>$id]);
    }
}
