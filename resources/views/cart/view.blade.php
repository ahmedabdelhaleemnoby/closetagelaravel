@extends('layouts.app')
@section('content')


<section class="h-100 py-5 mt-5" style="background-color: #eee;">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                </div>
                @foreach($carts as $cart)
                <div class="card rounded-3 mb-4">
                    <div class="card-body p-4">

                        @php $total = $cart->price - @$cart->product->discount @endphp
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img src="{{@$cart->product->dir.@$cart->product->image}}" class="img-fluid rounded-3" alt="{{@$cart->product->name}}">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <p class="lead fw-normal mb-2">{{@$cart->product->name}}</p>
                                <p><span class="text-muted">price: </span>$
                                    <span id="price_{{$cart->id}}">{{$total}}</span>
                                    <!-- <span class="text-muted">Total: </span>$... -->
                                </p>
                            </div>

                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                <button class="btn btn-link px-2 minus" type="submit" name="minus" id="{{$cart->id}}">
                                    <i class="fas fa-minus"></i>
                                </button>

                                <input id="form{{$cart->id}}" min="0" name="plus" value="{{$cart->qty}}" type="number" class="form-control form-control-sm" />
                                <input type="hidden" value="{{$cart->id}}" name="pid" id="here">
                                <button class="btn btn-link px-2 plus" type="submit" name="plus" id="{{$cart->id}}">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                <h5 class="mb-0" id="total_{{$cart->id}}">${{$total * $cart->qty}}</h5>
                            </div>


                            <form class="col-md-1 col-lg-1 col-xl-1 text-end" action="{{route('carts.destroy', $cart->id)}}" method="POST">
                                @csrf
                                @method('Delete')
                                <input type="hidden" value="..." name="dpid">
                                <button type="submit" class="border-0 btn  btn-outline-danger" name="delete"><i class="fas fa-trash fa-lg"></i></button>
                            </form>
                        </div>

                    </div>
                </div>
                @endforeach


                <div class="card mb-4">
                    <div class="card-body p-4 d-flex flex-row">
                        <div class="form-outline flex-fill">
                            <input type="text" id="form1" class="form-control form-control-lg" />
                            <label class="form-label" for="form1">Discount code</label>
                        </div>
                        <button type="button" class="btn btn-outline-warning btn-lg ms-3">Apply</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <a href="{{url('/checkouts')}}" type="button" class="btn btn-warning btn-block btn-lg">Proceed to Pay</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script>
    $(".minus").click(function() {
        var thiz = this;
        var price = $("#price_" + thiz.id).text()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "/cart/minus",
            method: 'post',
            data: {
                id: this.id
            },
            success: function(result) {
                $('#form' + thiz.id).val(result)
                $("#total_" + thiz.id).html("$" + result * price)
                $("#count").html(+$("#count").html() - 1)
            },

        });
    })
    $(".plus").click(function() {
        var thiz = this;
        var price = $("#price_" + thiz.id).text()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "/cart/plus",
            method: 'post',
            data: {
                id: this.id
            },
            success: function(result) {
                $('#form' + thiz.id).val(result)
                $("#total_" + thiz.id).html("$" + result * price)
                $("#count").html(+$("#count").html() + 1)
            },

        });
    })
</script>
@endsection
