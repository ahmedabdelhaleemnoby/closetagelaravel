<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;


class HomeController extends Controller
{
    public $id;
    public function __construct()
    {

        $this->middleware('admin');
        $this->middleware(function ($request, $next) {
            $this->id = Auth::guard('admin');
            return $next($request);
        });
    }
    public function home()
    {
        return view('admin.home');
    }
}
