@extends('admin.layout.app')
@section('content')
<div class="container d-flex flex-column">

    <div class="row">
        <h1 class="text-success mt-4 mb-4">Add Images</h1>
    </div>
    <form action="{{url('/admin/add/image')}}" method="post" class="p-8 " enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- <input type="text" class="col-md-12 form-control mb-2"> -->
            @if(session()->has('success'))
            <div class="alert alert-success">
                Admin has been successful added
            </div>`
            @endif
            @if($errors->first())
            <div class="alert alert-danger">
                {{$errors->first()}}
            </div>
            @endif
        </div>

        <div class="row ">
            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">Upload image</label>
                <input class="form-control" name="image" type="file" id="formFileMultiple" multiple>
            </div>
            <br>
            <input type="text" name="title" class="col-md-12 form-control mb-2 ms-2" placeholder="Title">
            <br>
            <input type="text" name="description" class="col-md-12 form-control mb-2 ms-2" placeholder="Enter description">
            <br>
            <button type="submit" class="btn btn-success col-md-2 mb-2 mt-2 ms-2">Upload Image</button>
        </div>
    </form>
</div>
@endsection
