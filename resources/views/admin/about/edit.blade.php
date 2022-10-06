@extends('admin.layout.app')
@section('content')
<div class="container d-flex flex-column">

    <div class="row">
        <h1 class="text-success mt-4 mb-4">edit image</h1>
    </div>
    <form action="{{route('about.update',['about' => $about->id ])}}" method="POST" class="p-8 " enctype="multipart/form-data">
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
            <img src="{{$about->dir}}/{{$about->image}}" alt="{{$about->title}}" style="width: 100px; hight: 100px;">
            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">Upload image</label>
                <input class="form-control" name="image" type="file" id="formFileMultiple" multiple>
            </div>
            <br>
            <input type="text" name="title" class="col-md-12 form-control mb-2" placeholder="Enter name title" value="{{$about->title}}">
            <br>
            <input type="text" name="description" class="col-md-12 form-control mb-2" placeholder="Enter description" value="{{$about->description}}">
            <br>
            <button type="submit" class=" form-control btn btn-success ">Update</button>
        </div>
    </form>
</div>
@endsection
