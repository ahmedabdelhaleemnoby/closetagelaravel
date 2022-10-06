<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = Feature::all();
        return view('admin/feature/view', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/feature/create');
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
        $dir = public_path('/images/feature/');
        $file->move($dir, $fileName);
        $addFeature = new Feature();
        $addFeature->dir = '/images/feature/';
        $addFeature->icon = $fileName;
        $addFeature->title = $request->input('title');
        $addFeature->description = $request->input('description');
        $addFeature->save();
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
    public function edit($feature)
    {
        return view('admin.feature.edit', [
            'feature' => Feature::findOrFail($feature),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $feature)
    {
        $this->validate(
            $request,
            [
                'title' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'description' => ['required',],

            ]
        );

        $updateFeature = Feature::findOrFail($feature);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . "_" . rand(00000000, 99999999) . '.' . $file->getClientOriginalExtension();
            $dir = public_path('/images/about/');
            $file->move($dir, $fileName);
            $updateFeature->dir = '/images/about/';
            $updateFeature->image = $fileName;
        }
        $updateFeature->title = $request->input('title');
        $updateFeature->description = $request->input('description');
        $updateFeature->save();
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($feature)
    {
        $deleteFeature = Feature::findOrFail($feature);
        $deleteFeature->delete();
        return redirect()->back()->with('success', 'success');
    }
}
