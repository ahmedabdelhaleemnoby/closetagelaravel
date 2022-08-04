<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use session;
use Validator;


class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        return view('register');
    }


    public function submit(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'required|unique:users|max:255|min:4',
                'password' => 'required|same:cpassword'
            ],
            // $messages = [
            //     'username.required' => 'please enter username',

            // ]


        );

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'success');
    }
}
