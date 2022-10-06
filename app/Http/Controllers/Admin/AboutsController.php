<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::all();
        return view('admin/about/view', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/about/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'image' => ['required'],
                'description' => ['required',],

            ]
        );
        $file = $request->file('image');
        $fileName = time() . "_" . rand(00000000, 99999999) . '.' . $file->getClientOriginalExtension();
        $dir = public_path('/images/about/');
        $file->move($dir, $fileName);
        $addAbout = new About();
        $addAbout->dir = '/images/about/';
        $addAbout->image = $fileName;
        $addAbout->title = $request->input('title');
        $addAbout->description = $request->input('description');
        $addAbout->save();
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($about)
    {
        return view('admin.about.edit', [
            'about' => About::findOrFail($about),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $about)
    {
        $this->validate(
            $request,
            [
                'title' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'description' => ['required',],

            ]
        );

        $updateAbout = About::findOrFail($about);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . "_" . rand(00000000, 99999999) . '.' . $file->getClientOriginalExtension();
            $dir = public_path('/images/about/');
            $file->move($dir, $fileName);
            $updateAbout->dir = '/images/about/';
            $updateAbout->image = $fileName;
        }
        $updateAbout->title = $request->input('title');
        $updateAbout->description = $request->input('description');
        $updateAbout->save();
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($about)
    {
        $deleteAbout = About::findOrFail($about);
        $deleteAbout->delete();
        return redirect()->back()->with('success', 'success');
    }
}
