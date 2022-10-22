<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (Auth::id()) {
            $addresses = Address::all();
            $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));
            $carts = Cart::where('session', $sessionId)->get();
            foreach ($carts as $cart) {
                $product = @Product::find($cart->product);
                $cart->product = $product;
            }
            return view('checkout', compact('addresses', 'carts'));
        } else {
            return redirect('login');
        }
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
        $this->validate(
            $request,
            [
                'name' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'firstname' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'lastname' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'username' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
                'email' => ['email:rfc,dns'],
                'category' => ['required'],
                'address' => ['required'],
                'address2' => ['required'],
                'country' => ['required',],
                'state' => ['required',],
                'zip' => ['required', 'numeric']
            ]
        );
        if ($request->select('select_address') == 0) {
            $addAddress = new Address();
            $addAddress->user_id = $request->Auth::id();
            $addAddress->name = $request->input('name_address');
            $addAddress->firstname = $request->input('firstName');
            $addAddress->lastname = $request->input('lastName');
            $addAddress->email = $request->input('email');
            $addAddress->address = $request->input('address');
            $addAddress->address2 = $request->input('address2');
            $addAddress->country = $request->input('country');
            $addAddress->state = $request->input('state');
            $addAddress->zip = $request->input('zip');
            $addAddress->save();
            return redirect()->back()->with('success', 'success');
        } else {
        }
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
        //
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
