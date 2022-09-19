@extends('admin.layout.app')
@section('content')
<div class="container d-flex flex-column">

    <div class="row">
        <h1 class="text-success mt-4 mb-4">Add product</h1>
    </div>
    <form action="{{route('products.store')}}" method="post" class="p-8 " enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- <input type="text" class="col-md-12 form-control mb-2"> -->
            @if(session()->has('success'))
            <div class="alert alert-success">
                Tittle has been successful added
            </div>`
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
            <input type="text" name="name" class="col-md-12 form-control mb-2" placeholder="Enter name product" value="{{old('name')}}">
            <br>
            <input type="number" name="price" class="col-md-12 form-control mb-2" placeholder="Enter price" value="{{old('price')}}">
            <br>
            <input type="text" name="description" class="col-md-12 form-control mb-2" placeholder="Enter description" value="{{old('description')}}">
            <br>
            <input type="text" name="discount" class="col-md-12 form-control mb-2" placeholder="Enter discount" value="{{old('discount')}}">
            <br>
            <input type="number" name="quantity" class="col-md-12 form-control mb-2" placeholder="Enter quantity" value="{{old('quantity')}}">
            <button type="submit" class="btn btn-success col-md-2 mb-2">Add</button>
        </div>
    </form>
</div>
@endsection
