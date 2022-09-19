@extends('admin.layout.app')
@section('content')
<div class="container mt-4">
    @if(session()->has('deleted'))
    <div class="alert alert-success">
        Admin has been successful deleted
    </div>
    @endif
    <div class="row">
        <table class="table table-success table-striped">

            <tr>
                <th>#</th>
                <th>category</th>
                <th>Name Product</th>
                <th>Price</th>
                <th>Description</th>
                <th>Discount</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->category_id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->discount}}</td>
                <td>{{$product->quantity}}</td>
                <td> <a class="btn btn-primary" href="{{url('/admin/products/'.$product->id.'/edit')}}">Edit</a> <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_{{$product->id}}">Delete</a>
                    <div class="modal fade" id="modal_{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete {{$product->Name}} ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('products.destroy', $product->id)}}" method="post">
                                        @csrf
                                        @method('Delete')
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
