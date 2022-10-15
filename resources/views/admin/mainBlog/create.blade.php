@extends('admin.layout.app')
@section('content')
<div class="container d-flex flex-column">

    <div class="row">
        <h1 class="text-success mt-4 mb-4">Add Main Blog</h1>
    </div>
    <form action="{{route('mainBlog.store')}}" method="post" class="p-8 " enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- <input type="text" class="col-md-12 form-control mb-2"> -->
            @if(session()->has('success'))
            <div class="alert alert-success">
                Main Blog has been successful added
            </div>
            @endif
            @if($errors->first())
            <div class="alert alert-danger">
                {{$errors->first()}}
            </div>
            @endif
        </div>
        <div class="row ">
            <br>
            <input type="text" name="title" class="col-md-12 form-control mb-2" placeholder="Enter title MainBlog" value="{{old('name')}}">
            <br>
            <input type="text" name="description" class="col-md-12 form-control mb-2" placeholder="Enter description" value="{{old('description')}}">
            <br>
            <button type="submit" class="btn btn-success col-md-2 mb-2">Add Main Blog</button>
        </div>
    </form>
</div>
@endsection
