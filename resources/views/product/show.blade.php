@extends('layouts.app')
@section('content')


<!-- Product Start -->
<div class="container-xxl py-5">
    <div class="container py-5 mt-5">
        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">

                    <div class=" col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="product-item">
                            <div class="position-relative bg-light overflow-hidden">
                                <img class="img-fluid w-100" src="{{$product->dir}}/{{$product->image}}" alt="">
                                <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">New</div>
                            </div>

                        </div>
                    </div>
                    <div class=" col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="product-item">

                            <div class="text-center p-4">
                                <a class="d-block h5 mb-2" href="">{{$product->name}}</a>
                                <p class="m-5">{{$product->description}}</p>
                                <span class="text-primary me-1">${{$product->price - $product->discount}}.00</span>
                                <span class="text-body text-decoration-line-through">${{$product->price}}</span>
                            </div>
                            <div class="d-flex border-top">

                                <small class="w-50 text-center py-2">
                                    <form action="{{route('carts.store',Array('id'=>$product->id))}}" method="post" class="p-8 " enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="product" value="{{$product->id}}">

                                        <button type="submit" class="text-body btn btn-sm"><i class="fa fa-shopping-bag text-primary me-2"></i>Add to cart</button>
                                    </form>
                                </small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 py-5">
                <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-5 mb-3">Other Products</h1>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Product End -->


@endsection
