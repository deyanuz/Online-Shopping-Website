<?php

namespace App\Http\Controllers;

use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Carbon\Carbon;
class AdminAddSlideController extends Controller
{
    public function storeSlide(Request $request)
    {
         $validatedData = $request->validate([
            'top_title' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string',
            'offer' => 'required|string',
            'link' => 'required',
            'status' => 'required',
            'image' => 'required',
         ]);


        $imageName = Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('slider',$imageName);

        $homeSlider = new HomeSlider();
        $homeSlider->top_title = $validatedData['top_title'];
        $homeSlider->title = $validatedData['title'];
        $homeSlider->sub_title = $validatedData['sub_title'];
        $homeSlider->offer = $validatedData['offer'];
        $homeSlider->link = $validatedData['link'];
        $homeSlider->status = $validatedData['status'];
        $homeSlider->image = $validatedData['image'];
        $homeSlider->image = $imageName;
        $homeSlider->save();

        return redirect()->route("admin.addSlide")->with("success", "Slide Added Successfully!");
    }
    public function index(){
        return view("auth.addSlide");
    }
}
