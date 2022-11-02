<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutsController extends Controller
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
            $payments = Payment::where('pay_way', 1)->get();
            $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));
            $carts = Cart::where('session', $sessionId)->get();
            foreach ($carts as $cart) {
                $product = @Product::find($cart->product);
                $cart->product = $product;
            }
            return view('checkout', compact('addresses', 'carts', 'payments'));
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
                'name_address' => ['required', 'max:255'],
                'firstName' => ['required',  'max:255'],
                'lastName' => ['required',  'max:255'],
                'email' => ['email:rfc,dns'],
                'address' => ['required'],
                'address2' => ['required'],
                'country' => ['required',],
                'state' => ['required',],
                'zip' => ['required', 'numeric'],
                'shippingMethods' => ['required', 'numeric'],
                'subtotal' => ['required', 'numeric'],
            ]
        );
        if ($request->input('select_address') == 0) {
            $addAddress = new Address();
            $addAddress->user_id = Auth::id();
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

            $addPayment = new Payment();
            $addPayment->ship_way = $request->input('shippingMethods');
            $addPayment->pay_way = $request->input('paymentMethods');
            $addPayment->user_id = Auth::id();
            $addPayment->subtotal = $request->input('subtotal');
            if ($request->input('paymentMethods') == 1) {
                if ($request->input('card') == 0) {

                    $addPayment->type_card = $request->input('type_card');
                    $addPayment->name = $request->input('cc_name');
                    $addPayment->number = $request->input('cc_number');
                    $addPayment->exp = $request->input('cc_expiration');
                    $addPayment->ccv = $request->input('cc_cvv');
                } else {
                    $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));
                    Cart::where('session', $sessionId)->update([
                        'payment_id' => $request->input('card'),
                        'on_order' => "1",
                    ]);
                }
            } else {
                $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));
                Cart::where('session', $sessionId)->update([
                    'payment_id' => $request->input('paymentMethods'),
                    'on_order' => "1",
                ]);
            }
            $addPayment->save();

            $addOrder = new Order();
            $addOrder->subtotal = $request->input('subtotal');
            $addOrder->ship_fees = $request->input('shippingMethods');
            $addOrder->address_id = $request->input('select_address');
            $addOrder->payment_id = $addPayment->id;
            $addOrder->user_id = Auth::id();
            $addOrder->status = "ordered";
            $addOrder->save();
            $products =  Cart::where('session', $sessionId)->get();
            foreach ($products as $product) {
                $addOrderDetails = new OrderDetails();
                $addOrderDetails->order_id =  $addOrder->id;
                $addOrderDetails->product = $product->product;
                $addOrderDetails->qty = $product->qty;
                $addOrderDetails->price = $product->price;
                $addOrderDetails->save();
                $product->delete();
            }


            // $addOrderDetails->product =  Cart::where('session', $sessionId)->find('product')->get();


            $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));
            Cart::where('session', $sessionId)->update([
                'payment_id' => $addPayment->id,
                'address_id' => $addAddress->id,
                'on_order' => "1",
            ]);
        } else {
            $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));
            Cart::where('session', $sessionId)->update([
                'address_id' =>  $request->input('select_address'),
                'on_order' => "1",
            ]);

            $addPayment = new Payment();
            $addPayment->ship_way = $request->input('shippingMethods');
            $addPayment->pay_way = $request->input('paymentMethods');
            $addPayment->user_id = Auth::id();
            $addPayment->subtotal = $request->input('subtotal');
            if ($request->input('paymentMethods') == 1) {
                if ($request->input('card') == 0) {

                    $addPayment->type_card = $request->input('type_card');
                    $addPayment->name = $request->input('cc_name');
                    $addPayment->number = $request->input('cc_number');
                    $addPayment->exp = $request->input('cc_expiration');
                    $addPayment->ccv = $request->input('cc_cvv');
                } else {
                    $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));
                    Cart::where('session', $sessionId)->update([
                        'payment_id' => $request->input('card'),
                        'on_order' => "1",
                    ]);
                }
            } else {
                $sessionId = base64_encode($request->server('HTTP_USER_AGENT'));
                Cart::where('session', $sessionId)->update([
                    'payment_id' => $request->input('paymentMethods'),
                    'on_order' => "1",
                ]);
            }
            $addPayment->save();

            $addOrder = new Order();
            $addOrder->subtotal = $request->input('subtotal');
            $addOrder->ship_fees = $request->input('shippingMethods');
            $addOrder->address_id = $request->input('select_address');
            $addOrder->payment_id = $addPayment->id;
            $addOrder->user_id = Auth::id();
            $addOrder->status = "ordered";
            $addOrder->save();
            $products =  Cart::where('session', $sessionId)->get();
            foreach ($products as $product) {
                $addOrderDetails = new OrderDetails();
                $addOrderDetails->order_id =  $addOrder->id;
                $addOrderDetails->product = $product->product;
                $addOrderDetails->qty = $product->qty;
                $addOrderDetails->price = $product->price;
                $addOrderDetails->save();
                $product->delete();
            }
        }

        return redirect('/summary');
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
    public function address(Request $request)
    {
        $address = Address::where('id', $request->id)->first();
        return response()->json(['address' => $address]);
    }
    public function card(Request $request)
    {
        $card = Payment::where('id', $request->id)->first();
        return response()->json(['card' => $card]);
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
