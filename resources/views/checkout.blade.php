@extends('layouts.app')

@section('content')

<div class="container py-5 mt-5">
    <div class="py-5 text-center">

        <h2>Checkout form</h2>
        <!-- <p class="lead">Below is an example form built entirely with Bootstrap 5 form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p> -->
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <!-- <span class="badge badge-secondary badge-pill">3</span> -->
            </h4>
            <ul class="list-group mb-3">
                @php $subtotal=0; @endphp
                @foreach($carts as $cart)
                @php $price = $cart->price - $cart->discount ;
                $total=$price * $cart->qty;
                @endphp
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{@$cart->product->name}}</h6>
                        <small class="text-muted">${{$price}}</small>
                    </div>
                    <span class="text-muted">${{$total}}.00</span>
                </li>
                @php
                $subtotal += $total;
                @endphp
                @endforeach
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                        <small>EXAMPLE CODE</small>
                    </div>
                    <span class="text-success">$0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$ {{$subtotal}}.00 </strong>
                </li>
            </ul>
            <form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Shipping address</h4>
            <form class="needs-validation" novalidate method="POST" action="">
                <div class="col-12">
                    <label for="country">Select Address</label>
                    <select class="custom-select d-block w-100 " id="select_address" style="height: 38px; " name="select_address" required>
                        @foreach($addresses as $address)
                        <option value="{{$address->id}}">{{$address->name}}</option>
                        @endforeach
                        <option value="0">+ Add new address...</option>
                    </select>
                    <!-- <div class="invalid-feedback">
                        Please select a valid Address.
                    </div> -->
                </div>
                <div class="col-md-12">
                    <label for="firstName">Name address</label>
                    <input type="text" class="form-control" name="name_address" id="name" placeholder="Home,Work etc..." value="" required>
                    <!-- <div class="invalid-feedback">
                        Valid first name is required.
                    </div> -->

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required>
                            <!-- <div class="invalid-feedback">
                                Valid first name is required.
                            </div> -->
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="" required>
                            <!-- <div class="invalid-feedback">
                                Valid last name is required.
                            </div> -->
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="email">Email
                            <!-- <span class="text-muted">(Optional)</span> -->
                        </label>
                        <input type="email" class="form-control" name="email" id="email" value="">
                        <!-- <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div> -->
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
                        <!-- <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div> -->
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2
                            <!-- <span class="text-muted">(Optional)</span> -->
                        </label>
                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="">
                            <!-- <div class="invalid-feedback">
                                Please select a valid country.
                            </div> -->
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="">
                            <!-- <div class="invalid-feedback">
                                Please provide a valid state.
                            </div> -->
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="" required>
                            <!-- <div class="invalid-feedback">
                                Zip code required.
                            </div> -->
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Shipping Way</h4>
                    <div class="d-block my-3" id="select_shipping">
                        <div class="custom-control custom-radio">
                            <input id="home" name="shippingMethods" type="radio" class="custom-control-input" value="15" checked required>
                            <label class="custom-control-label" for="home"> delivery to home</label>
                            <small class="text-muted ms-3">(3-5 Work days fees $15)</small>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="express" name="shippingMethods" type="radio" class="custom-control-input" value="25" required>
                            <label class="custom-control-label" for="express">express shipping</label>
                            <small class="text-muted ms-3">(1-2 Work days fees $25)</small>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Payment way</h4>

                    <div class="d-block my-3" id="select_card">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethods" type="radio" class="custom-control-input nochecked" value="0" checked required>
                            <label class="custom-control-label" for="credit">Cash on delivery</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethods" type="radio" class="custom-control-input checked" value="1" required>
                            <label class="custom-control-label" for="debit">Pay with card</label>
                        </div>
                    </div>

                    <section class="credit_card">
                        <h4 class="mb-3">Payment</h4>
                        <label for="country">Select card</label>
                        <select class="custom-select d-block w-100 " id="card" style="height: 38px; " name="card" required>
                            <option value="0">select card...</option>

                            <option value="cards['id']">cards['name']</option>
                        </select>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="credit" name="paymentMethod" value="Credit card" type="radio" class="custom-control-input" checked required>
                                <label class="custom-control-label" for="credit">Credit card</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" name="paymentMethod" value="Debit card" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="debit">Debit card</label>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" name="cc_name" placeholder="" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" name="cc_number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="cc-expiration">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" name="cc_expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cc-cvv">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" name="cc_cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                    </section>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">place order</button>
            </form>
        </div>
    </div>


</div>
@endsection
