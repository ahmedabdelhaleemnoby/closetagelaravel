@extends('admin.layout.app')
@section('content')
<div class="container d-flex flex-column">

    <div class="row">
        <h1 class="text-success mt-4 mb-4">edit Review</h1>
    </div>
    <form action="{{route('reviews.update',['review' => $review->id ])}}" method="POST" class="p-8 " enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- <input type="text" class="col-md-12 form-control mb-2"> -->
            @if(session()->has('success'))
            <div class="alert alert-success">
                Review has been successful update
            </div>
            @endif
            @if($errors->first())
            <div class="alert alert-danger">
                {{$errors->first()}}
            </div>
            @endif
        </div>

        <div class="row ">
            <img src="{{$review->dir}}/{{$review->image}}" alt="{{$review->title}}" style="width: 100px; height: 100px;">
            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">Upload image</label>
                <input class="form-control" name="image" type="file" id="formFileMultiple" multiple>
            </div>
            <br>
            <input type="text" name="title" class="col-md-12 form-control mb-2" placeholder="Enter name title" value="{{$review->title}}">
            <br>
            <input type="text" name="description" class="col-md-12 form-control mb-2" placeholder="Enter description" value="{{$review->description}}">
            <br>
            <input type="text" name="title_job" class="col-md-12 form-control mb-2" placeholder="Enter name title job" value="{{$review->title_job}}">
            <br>
            <button type="submit" class=" form-control btn btn-success ">Update</button>
        </div>
    </form>
</div>
@endsection
