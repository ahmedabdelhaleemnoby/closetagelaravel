<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin/blog/view', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/blog/create');
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
                'title' => ['required', 'max:255'],
                'image' => ['required'],

            ]
        );
        $file = $request->file('image');
        $fileName = time() . "_" . rand(00000000, 99999999) . '.' . $file->getClientOriginalExtension();
        $dir = public_path('/images/review/');
        $file->move($dir, $fileName);
        $addBlog = new Blog();
        $addBlog->dir = '/images/review/';
        $addBlog->image = $fileName;
        $addBlog->title = $request->input('title');
        $addBlog->save();
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
    public function edit($blog)
    {
        return view('admin.blog.edit', [
            'blog' => Blog::findOrFail($blog),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $blog)
    {
        $this->validate(
            $request,
            [
                'title' => ['required', 'max:255'],
                'image' => ['required'],

            ]
        );

        $updateBlog = Blog::findOrFail($blog);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . "_" . rand(00000000, 99999999) . '.' . $file->getClientOriginalExtension();
            $dir = public_path('/images/review/');
            $file->move($dir, $fileName);
            $updateBlog->dir = '/images/review/';
            $updateBlog->image = $fileName;
        }
        $updateBlog->title = $request->input('title');
        $updateBlog->save();
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($blog)
    {
        $deleteBlog = Blog::findOrFail($blog);
        $deleteBlog->delete();
        return redirect()->back()->with('success', 'success');
    }
}
