@extends('layouts.app')
@section('content')
<div class="p-5"></div>
<section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-8 col-xl-6">
                <div class="card border-top border-bottom border-3" style="border-color: #f37a27 !important;">
                    <div class="card-body p-5">

                        <p class="lead fw-bold mb-5" style="color: #f37a27;">Summary</p>

                        <div class="row">
                            <div class="col mb-3">
                                <p class="small text-muted mb-1">Date</p>
                                <p>{{$orders->updated_at}}</p>
                            </div>
                            <div class="col mb-3">
                                <p class="small text-muted mb-1">Order No.</p>
                                <p>{{$orders->address_id}}_{{$orders->payment_id}}</p>
                            </div>
                        </div>

                        <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                            @foreach($orderDetails as $orderDetail)
                            <div class="row">
                                <div class="col-md-8 col-lg-9">
                                    <p>{{@$orderDetail->product->name}}</p>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <span>${{$orderDetail->price - @$orderDetail->product->discount}}</span>
                                    <span class="text-body text-decoration-line-through">${{$orderDetail->price}}</span>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-md-8 col-lg-9">
                                    <p class="mb-0">Shipping</p>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <p class="mb-0">${{$orders->ship_fees}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row my-4">
                            <div class="col-md-4 offset-md-8 col-lg-3 offset-lg-9">
                                <p class="lead fw-bold mb-0" style="color: #f37a27;">${{$orders->ship_fees+$orders->subtotal}}</p>
                            </div>
                        </div>

                        <p class="lead fw-bold mb-4 pb-2" style="color: #f37a27;">Tracking Order</p>

                        <div class="row">
                            <div class="col-lg-12">

                                <div class="horizontal-timeline">

                                    <ul class="list-inline items d-flex justify-content-between">
                                        <li class="list-inline-item items-list">
                                            <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">Ordered</p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                                        </li>
                                        <li class="list-inline-item items-list">
                                            <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">Shipped</p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                                        </li>
                                        <li class="list-inline-item items-list">
                                            <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">On the way
                                            </p>
                                        </li>
                                        <li class="list-inline-item items-list text-end" style="margin-right: 8px;">
                                            <p style="margin-right: -8px;">Delivered</p>
                                        </li>
                                    </ul>

                                </div>

                            </div>
                        </div>

                        <p class="mt-4 pt-2 mb-0">Want any help? <a href="#!" style="color: #f37a27;">Please contact
                                us</a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
