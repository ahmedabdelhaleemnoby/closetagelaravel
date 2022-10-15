<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Firm;
use Illuminate\Http\Request;

class FirmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firms = Firm::all();
        return view('admin/firm/view', compact('firms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/firm/create');
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
        $addFirm = new Firm();
        $addFirm->title = $request->input('title');
        $addFirm->description = $request->input('description');
        $addFirm->save();
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
    public function edit($firm)
    {
        return view('admin.firm.edit', [
            'firm' => Firm::findOrFail($firm),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $firm)
    {
        $this->validate(
            $request,
            [
                'tittle' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'description' => ['required',],


            ]
        );
        $updateFirm = Firm::findOrFail($firm);
        $updateFirm->tittle = $request->input('tittle');
        $updateFirm->description = $request->input('description');
        $updateFirm->save();
        return redirect()->back()->with('success', 'success');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($firm)
    {
        $deleteFirm = Firm::findOrFail($firm);
        $deleteFirm->delete();
        return redirect()->back()->with('success', 'success');
    }
}
