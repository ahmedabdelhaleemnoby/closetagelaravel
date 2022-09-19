@extends('admin.layout.app')
@section('content')
<div class="container d-flex flex-column">

    <div class="row">
        <h1 class="text-success mt-4 mb-4">edit image</h1>
    </div>
    <form action="{{route('products.update',['product' => $product->id ])}}" method="POST" class="p-8 " enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- <input type="text" class="col-md-12 form-control mb-2"> -->
            @if(session()->has('success'))
            <div class="alert alert-success">
                Admin has been successful update
            </div>
            @endif
            @if($errors->first())
            <div class="alert alert-danger">
                {{$errors->first()}}
            </div>
            @endif
        </div>

        <div class="row ">
            <select name="category">
                <option>select category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->tittle}}</option>
                @endforeach
            </select>
            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">Upload image</label>
                <input class="form-control" name="image" type="file" id="formFileMultiple" multiple>
            </div>
            <br>
            <input type="text" name="name" class="col-md-12 form-control mb-2" placeholder="Enter name product" value="{{$product->name}}">
            <br>
            <input type="number" name="price" class="col-md-12 form-control mb-2" placeholder="Enter price" value="{{$product->price}}">
            <br>
            <input type="text" name="description" class="col-md-12 form-control mb-2" placeholder="Enter description" value="{{$product->description}}">
            <br>
            <input type="text" name="discount" class="col-md-12 form-control mb-2" placeholder="Enter discount" value="{{$product->discount}}">
            <br>
            <input type="number" name="quantity" class="col-md-12 form-control mb-2" placeholder="Enter quantity" value="{{$product->quantity}}">
            <button type="submit" class=" form-control btn btn-success ">Update</button>
        </div>
    </form>
    </form>
</div>
@endsection
