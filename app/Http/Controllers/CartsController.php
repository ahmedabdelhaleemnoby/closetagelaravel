<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use session;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

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
        $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));

        $cCarts = Cart::where('session', $sessionId)->get();
        $count = 0;
        foreach ($cCarts as $cCert) {
            $myCert = $cCert->qty;
            $count += $myCert;
        }
        $value = $count;



        $carts =  $cCarts;


        foreach ($carts as $cart) {

            $product = @Product::find($cart->product);
            $cart->product = $product;
        }



        return view('cart/view', compact('carts'));
        // return redirect()->back()->with('success', 'success');
    }

    public function minus(Request $request)
    {
        $count = $request->session()->get('count');
        if ($count == null) {
            $cCarts = Cart::all();
            $count = 0;
            foreach ($cCarts as $cCert) {
                $myCert = $cCert->qty;
                $count += $myCert;
            }
            $value = $count;
            $request->session()->put('count', $value);
        }
        $cart = Cart::where([['id', '=', $request->id]])->first();
        $cart->qty -= 1;
        $cart->update();
        $value = $request->session()->get('count');
        $value -= 1;
        $request->session()->put('count', $value);
        return $cart->qty;
    }
    public function plus(Request $request)
    {
        $count = $request->session()->get('count');
        if ($count == null) {
            $cCarts = Cart::all();
            $count = 0;
            foreach ($cCarts as $cCert) {
                $myCert = $cCert->qty;
                $count += $myCert;
            }
            $value = $count;
            $request->session()->put('count', $value);
        }
        $cart = Cart::where([['id', '=', $request->id]])->first();
        $cart->qty += 1;
        $cart->update();
        $value = $request->session()->get('count');
        $value += 1;
        $request->session()->put('count', $value);
        return $cart->qty;
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
        $count = $request->session()->get('count');
        if ($count == null) {
            $cCarts = Cart::all();
            $count = 0;
            foreach ($cCarts as $cCert) {
                $myCert = $cCert->qty;
                $count += $myCert;
            }
            $value = $count;
            $request->session()->put('count', $value);
        }
        $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));
        $cart = Cart::where([['product', '=', $request->product]])->first();
        $product = Product::findOrFail($request->product);
        if ($cart == null) {
            //1- first if product not in cart
            $addToCart = new Cart();
            $addToCart->session = $sessionId;
            $addToCart->product = $request->product;
            $addToCart->qty = 1;
            $addToCart->price = $product->price;
            $addToCart->save();
            $value = $request->session()->get('count');
            $value += 1;
            $request->session()->put('count', $value);
        } else {
            //2- if product  in cart
            $cart->qty += 1;
            $cart->update();
            $value = $request->session()->get('count');
            $value += 1;
            $request->session()->put('count', $value);
        }



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
    public function destroy(Request $request, $cart)
    {

        $delete = Cart::findOrFail($cart);
        $count = $delete->qty;
        $value = $request->session()->get('count');
        $value -= $count;
        $request->session()->put('count', $value);
        $delete->delete();
        return redirect()->back()->with('success', 'success');
    }
}
