<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSlider;
use Carbon\Carbon;

class AdminEditSlideController extends Controller
{
    public function updateSlide(Request $request, $id)
    {
        $validatedData = $request->validate([
            'top_title' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string',
            'offer' => 'required|string',
            'link' => 'required',
            'status' => 'required',
            'image' => '',
        ]);


        $homeSlider = HomeSlider::find($id);

        if ($request->hasFile('image')) {
            unlink(public_path("assets/imgs/slider/" . $homeSlider->image));
            $imageName = Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('slider', $imageName);
        }


        $homeSlider->top_title = $validatedData['top_title'];
        $homeSlider->title = $validatedData['title'];
        $homeSlider->sub_title = $validatedData['sub_title'];
        $homeSlider->offer = $validatedData['offer'];
        $homeSlider->link = $validatedData['link'];
        $homeSlider->status = $validatedData['status'];
        if ($request->hasFile('image')) {
            $homeSlider->image = $imageName;
        }
        $homeSlider->save();

        return redirect()->route("admin.homeSlider")->with("success", "Slide Added Successfully!");
    }

    public function deleteSlide($id)
    {
        $slide = HomeSlider::find($id);
        unlink(public_path("assets/imgs/slider/" . $slide->image));
        $slide->delete();
        return redirect()->route("admin.homeSlider")->with("success", "Slide Removed Successfully!");
    }

    public function index($id)
    {
        $slide = HomeSlider::find($id);
        return view("auth.editSlide", ["slide" => $slide, "id" => $id]);
    }
}
