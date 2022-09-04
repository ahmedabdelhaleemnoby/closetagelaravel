<?php

namespace App\Http\Controllers\Admin\image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class ImageController extends Controller
{
    public function addImage(Request $request)
    {
        if ($request->isMethod('post')) {

            $image = new Image;
            $image->image;
            $image->title;
            $image->description;
            $image->save();
            return redirect()->back()->with('success', 'success');
        }
        return view('admin.image.add');
    }
    public function images(Request $request)
    {
        $images = Slider::all();

        return view('admin.image.view', compact('images'));
    }
    public function edit(Request $request)
    {
        $image = Slider::find($request->id);
        if ($request->isMethod('post')) {

            $image->image;
            $image->title;
            $image->description;
            $image->update();
            return redirect()->back()->with('success', 'success');
        }
        return view('admin.image.edit', compact('image'));
    }
    public function delete(Request $request)
    {
        $image = Slider::find($request->id);
        $image->delete();

        return redirect()->back()->with('deleted', 'deleted');
    }
}
