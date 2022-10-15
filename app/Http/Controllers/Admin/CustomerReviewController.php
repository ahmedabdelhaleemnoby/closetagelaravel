<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use Illuminate\Http\Request;

class CustomerReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerReviews = CustomerReview::all();
        return view('admin/customerReview/view', compact('customerReviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/customerReview/create');
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
        $addCustomerReview = new CustomerReview();
        $addCustomerReview->title = $request->input('title');
        $addCustomerReview->description = $request->input('description');
        $addCustomerReview->save();
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
    public function edit($customerReview)
    {
        return view('admin.customerReview.edit', [
            'customerReview' => CustomerReview::findOrFail($customerReview),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $customerReview)
    {
        $this->validate(
            $request,
            [
                'tittle' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'description' => ['required',],


            ]
        );
        $updateCustomerReview = CustomerReview::findOrFail($customerReview);
        $updateCustomerReview->tittle = $request->input('tittle');
        $updateCustomerReview->description = $request->input('description');
        $updateCustomerReview->save();
        return redirect()->back()->with('success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($customerReview)
    {
        $deleteCustomerReview = CustomerReview::findOrFail($customerReview);
        $deleteCustomerReview->delete();
        return redirect()->back()->with('success', 'success');
    }
}
