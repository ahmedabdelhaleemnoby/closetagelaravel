<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainFeature;
use Illuminate\Http\Request;

class MainFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainFeatures = MainFeature::all();
        return view('admin/mainFeature/view', compact('mainFeatures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/mainFeature/create');
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
                'description' => ['required',],

            ]
        );
        $addMainFeatures = new MainFeature();
        $addMainFeatures->title = $request->input('title');
        $addMainFeatures->description = $request->input('description');
        $addMainFeatures->save();
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
    public function edit($mainFeature)
    {
        return view('admin.mainFeature.edit', [
            'mainFeature' => MainFeature::findOrFail($mainFeature),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $MainFeature)
    {
        $this->validate(
            $request,
            [
                'tittle' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'description' => ['required',],


            ]
        );
        $updateMainFeatures = MainFeature::findOrFail($MainFeature);
        $updateMainFeatures->tittle = $request->input('tittle');
        $updateMainFeatures->description = $request->input('description');
        $updateMainFeatures->save();
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($mainFeature)
    {

        $deleteMainFeatures = MainFeature::findOrFail($mainFeature);
        $deleteMainFeatures->delete();
        return redirect()->back()->with('success', 'success');
    }
}
