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
            $this->validate(
                $request,
                [
                    'image' => ['required'],
                    'title' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                    'description' => ['required'],


                ]
            );
            $file = $request->file('image');
            $fileName = time() . "_" . rand(00000000, 99999999) . '.' . $file->getClientOriginalExtension();
            $dir = public_path('/images/slider/');
            $file->move($dir, $fileName);
            $image = new Slider;
            $image->title = $request->title;
            $image->description = $request->description;
            $image->image = $fileName;
            $image->dir = '/images/slider/';
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
            $this->validate(
                $request,
                [
                    'title' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                    'description' => ['required'],


                ]
            );
            if ($request->file('image') != null) {
                $file = $request->file('image');
                $fileName = time() . "_" . rand(00000000, 99999999) . '.' . $file->getClientOriginalExtension();
                $dir = public_path('/images/slider/');
                $file->move($dir, $fileName);
                $image->image = $fileName;
                $image->dir = '/images/slider/';
            }

            $image->title = $request->title;
            $image->description = $request->description;
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
