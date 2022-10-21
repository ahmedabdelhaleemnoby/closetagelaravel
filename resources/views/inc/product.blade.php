<!-- Product Start -->
<div class="container-xxl py-5" id="product">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-5 mb-3">Our Products</h1>
                    <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                </div>
            </div>
            <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary border-2  active" data-bs-toggle="pill" href="#tab-all">All</a>
                    </li>
                    @php
                    $x=1;
                    @endphp
                    @foreach($categories as $category)
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-{{$category->id}}">{{$category->tittle}}</a>
                    </li>
                    @php
                    $x++;
                    @endphp
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div id="tab-all" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    @foreach($productz as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="product-item">
                            <div class="position-relative bg-light overflow-hidden">
                                <a href="{{url('/product/'.$product->id)}}"><img class="img-fluid w-100" src="{{$product->dir.$product->image}}" alt=""></a>

                                <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">New</div>
                            </div>
                            <div class="text-center p-4">
                                <a class="d-block h5 mb-2" href="{{url('/product/'.$product->id)}}">{{$product->name}}</a>
                                <span class="text-primary me-1">${{$product->price - $product->discount}}</span>
                                <span class="text-body text-decoration-line-through">${{$product->price}}</span>
                            </div>
                            <div class="d-flex border-top">
                                <small class="w-50 text-center border-end py-2">
                                    <a class="text-body" href="{{url('/product/'.$product->id)}}"><i class="fa fa-eye text-primary me-2"></i>View detail</a>
                                </small>
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
                    @endforeach

                    <div class="col-12 text-center">
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="{{url('/products/')}}">Browse More Products</a>
                    </div>
                </div>
            </div>

            @foreach($categories as $category)
            <div id="tab-{{$category->id}}" class="tab-pane fade show p-0">
                <div class="row g-4">
                    @php

                    $products = DB::table('products')->where('category_id',$category->id)->limit(4)->get();

                    @endphp
                    @foreach($products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="product-item">
                            <div class="position-relative bg-light overflow-hidden">
                                <img class="img-fluid w-100" src="{{$product->dir.$product->image}}" alt="">
                                <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">New</div>
                            </div>
                            <div class="text-center p-4">
                                <a class="d-block h5 mb-2" href="">{{$product->name}}</a>
                                <span class="text-primary me-1">${{$product->price - $product->discount}}</span>
                                <span class="text-body text-decoration-line-through">${{$product->price}}</span>
                            </div>
                            <div class="d-flex border-top">
                                <small class="w-50 text-center border-end py-2">
                                    <a class="text-body" href="{{url('/product/'.$product->id)}}"><i class="fa fa-eye text-primary me-2"></i>View detail</a>
                                </small>
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
                    @endforeach

                    <div class="col-12 text-center">
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="{{url('/products/')}}">Browse More Products</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Product End -->
