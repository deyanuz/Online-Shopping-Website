<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;
class EditCategoryController extends Controller
{
    public function editCategory(Request $request,$id){
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => '',
            'is_popular'=>'required'
        ]);
        $category = Category::find($id);

        if ($request->hasFile('image')) {
            unlink(public_path("assets/imgs/categories/" . $category->image));
            $imageName = Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('categories', $imageName);
        }

        $category->name = $validatedData["name"];
        $category->slug = Str::slug($validatedData["slug"]);
        $category->is_popular = $validatedData['is_popular'];
        if ($request->hasFile('image')) {
            $category->image = $imageName;
        }
        $category->save();
        return redirect()->route("admin.addCategory")->with("success","Category Updated Successfully!");
    }
    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route("admin.categories")->with("success","Category Removed Successfully!");
    }
    public function index($id){
        $category = Category::find($id);
        return view("auth.editCategory",['id'=>$id,'category'=>$category]);
    }
}
