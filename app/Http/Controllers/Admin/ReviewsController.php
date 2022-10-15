<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();
        return view('admin/review/view', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/review/create');
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
                'title_job' => ['required', 'max:255'],
                'image' => ['required'],
                'description' => ['required',],

            ]
        );
        $file = $request->file('image');
        $fileName = time() . "_" . rand(00000000, 99999999) . '.' . $file->getClientOriginalExtension();
        $dir = public_path('/images/review/');
        $file->move($dir, $fileName);
        $addReview = new Review();
        $addReview->dir = '/images/review/';
        $addReview->image = $fileName;
        $addReview->title = $request->input('title');
        $addReview->description = $request->input('description');
        $addReview->title_job = $request->input('title_job');
        $addReview->save();
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
    public function edit($review)
    {
        return view('admin.review.edit', [
            'review' => Review::findOrFail($review),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $review)
    {
        $this->validate(
            $request,
            [
                'title' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'description' => ['required',],

            ]
        );

        $updateReview = Review::findOrFail($review);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . "_" . rand(00000000, 99999999) . '.' . $file->getClientOriginalExtension();
            $dir = public_path('/images/review/');
            $file->move($dir, $fileName);
            $updateReview->dir = '/images/review/';
            $updateReview->image = $fileName;
        }
        $updateReview->title = $request->input('title');
        $updateReview->description = $request->input('description');
        $updateReview->title_job = $request->input('title_job');
        $updateReview->save();
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($review)
    {
        $deleteReview = Review::findOrFail($review);
        $deleteReview->delete();
        return redirect()->back()->with('success', 'success');
    }
}
