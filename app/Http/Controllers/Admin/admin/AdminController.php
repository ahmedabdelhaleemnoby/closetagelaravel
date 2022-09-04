<?php

namespace App\Http\Controllers\Admin\admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function addAdmin(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate(
                $request,
                [
                    'fname' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                    'lname' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                    'username' => ['required', 'regex:/^[\pL\s]+$/u', 'unique:admins,username,' .  Auth::id(), 'max:255'],
                    'email' => ['required', 'unique:admins,email,' .  Auth::id(), 'email', 'max:255'],
                    'password' => ['required', 'string', 'max:255', 'same:cpassword'],


                    // 'fname_arabic' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                    // 'lname_arabic' => ['required', 'string', 'max:255'],
                    // 'nikname' => ['string', 'max:255'],
                    // 'username' => ['required', 'unique:users,username,' . Auth::id(), 'string', 'max:255'],
                    // 'email' => ['required', 'unique:users,email,' . Auth::id(), 'string', 'max:255'],
                    // 'description' => ['string', 'max:1000'],
                    // 'description_ar' => ['string', 'max:1000'],

                ]
            );
            //Admin::where('id','=','1')->first();
            $admin = new Admin;
            $admin->fname = $request->fname;
            $admin->lname = $request->lname;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->password = bcrypt($request->password);
            $admin->save();
            return redirect()->back()->with('success', 'success');
        }
        return view('admin.admin.add');
    }
    public function admins(Request $request)
    {
        $admins = Admin::all();

        return view('admin.admin.view', compact('admins'));
    }
    public function edit(Request $request)
    {
        $admin = Admin::find($request->id);
        if ($request->isMethod('post')) {
            $this->validate(
                $request,
                [
                    'fname' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                    'lname' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                    'username' => ['required', 'regex:/^[\pL\s]+$/u', 'unique:admins,username,' .  Auth::guard('admin')->id(), 'max:255'],
                    'email' => ['required', 'unique:admins,email,' .  Auth::guard('admin')->id(), 'email', 'max:255'],
                ]
            );

            if ($request->pasword != null) {
                $this->validate(
                    $request,
                    [

                        'password' => ['required', 'string', 'max:255', 'same:cpassword'],

                    ]
                );

                $admin->password = bcrypt($request->password);
            }
            //Admin::where('id','=','1')->first();
            $admin->fname = $request->fname;
            $admin->lname = $request->lname;
            $admin->username = $request->username;
            $admin->email = $request->email;

            $admin->update();
            return redirect()->back()->with('success', 'success');
        }
        return view('admin.admin.edit', compact('admin'));
    }
    public function delete(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin->delete();

        return redirect()->back()->with('deleted', 'deleted');
    }
}
