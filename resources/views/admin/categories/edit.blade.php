@extends('admin.layout.app')
@section('content')
<div class="container d-flex flex-column">

    <div class="row">
        <h1 class="text-success mt-4 mb-4">edit image</h1>
    </div>
    <form action="{{route('categories.update',['category' => $category->id ])}}" method="POST" class="p-8 ">
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

        <h1 class="text-success mt-4 mb-4 ms-2">Edit</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" class="form-control mb-2" name="tittle" placeholder="title" value="{{$category->tittle}}">
            <button type="submit" class=" form-control btn btn-success ">Update</button>
        </form>
    </form>
</div>
@endsection
