<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainBlog;
use Illuminate\Http\Request;

class MainBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainBlogs = MainBlog::all();
        return view('admin/mainBlog/view', compact('mainBlogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/mainBlog/create');
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
        $addMainBlog = new MainBlog();
        $addMainBlog->title = $request->input('title');
        $addMainBlog->description = $request->input('description');
        $addMainBlog->save();
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
    public function edit($mainBlog)
    {
        return view('admin.mainBlog.edit', [
            'mainBlog' => MainBlog::findOrFail($mainBlog),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $mainBlog)
    {
        $this->validate(
            $request,
            [
                'tittle' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'description' => ['required',],


            ]
        );
        $updateMainBlog = MainBlog::findOrFail($mainBlog);
        $updateMainBlog->tittle = $request->input('tittle');
        $updateMainBlog->description = $request->input('description');
        $updateMainBlog->save();
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($mainBlog)
    {
        $deleteMainBlog = MainBlog::findOrFail($mainBlog);
        $deleteMainBlog->delete();
        return redirect()->back()->with('success', 'success');
    }
}
