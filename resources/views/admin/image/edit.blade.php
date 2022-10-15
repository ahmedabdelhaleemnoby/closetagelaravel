@extends('admin.layout.app')
@section('content')
<div class="container d-flex flex-column">

    <div class="row">
        <h1 class="text-success mt-4 mb-4">edit image</h1>
    </div>
    <form action="{{url('/admin/edit/image/'.$image->id)}}" method="post" class="p-8 " enctype="multipart/form-data">
        @csrf
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

        <!-- <h1 class="text-success mt-4 mb-4 ms-2">Edit</h1> -->
        <form action="" method="post" enctype="multipart/form-data">
            <img src="{{$image->dir}}/{{$image->image}}" style="width: 100px; height: 100px;" alt="">
            <input type="file" class="form-control mb-2" name="image" placeholder="image" value="{{$image->dir}}/{{$image->image}}">
            <input type="text" class="form-control mb-2" name="title" placeholder="title" value="{{$image->title}}">
            <input type="text" class="form-control mb-2" name="description" placeholder="description" value="{{$image->description}}">

            <button type="submit" class=" form-control btn-success">Update</button>
        </form>
    </form>
</div>
@endsection
