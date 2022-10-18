<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use session;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $carts = Cart::all();
        $products = Product::all();
        if (Auth::id()) {
            $user = auth()->user()->email;
            $counts = Cart::where('session', $user)->count();
        } else {
            $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));
            $counts = Cart::where('session', $sessionId)->count();
        }
        return view('cart/view', compact('carts', 'products', 'counts'));
        // return redirect()->back()->with('success', 'success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(base64_encode($request->server('HTTP_USER_AGENT')));
        // session()->put('user', Auth::user()->id());
        // dd(session()->pull('test'));
        // $this->validate(
        //     $request,
        //     [
        //         'session' => ['required'],
        //         'product' => ['required'],
        //         'qty' => ['required', 'numeric'],
        //         'price' => ['required',  'numeric'],
        //     ]
        // );

        $product = Product::findOrFail($request->input('product'));
        $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));
        session()->put('user', $sessionId);
        $addCart = new Cart();
        if (Auth::id()) {
            $addCart->session =  auth()->user()->email;
        } else {
            $addCart->session = $sessionId;
        }
        $addCart->product = $product->name;
        $addCart->qty = 1;
        $addCart->price = $product->price;
        $addCart->save();
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
