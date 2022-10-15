@extends('admin.layout.app')
@section('content')
<div class="container d-flex flex-column">

    <div class="row">
        <h1 class="text-success mt-4 mb-4">edit Main Feature</h1>
    </div>
    <form action="{{route('mainFeature.update',['mainFeature' => $mainFeature->id ])}}" method="POST" class="p-8 " enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- <input type="text" class="col-md-12 form-control mb-2"> -->
            @if(session()->has('success'))
            <div class="alert alert-success">
                Main Feature has been successful update
            </div>
            @endif
            @if($errors->first())
            <div class="alert alert-danger">
                {{$errors->first()}}
            </div>
            @endif
        </div>

        <div class="row ">
            <input type="text" name="title" class="col-md-12 form-control mb-2" placeholder="Enter name title" value="{{$mainFeature->title}}">
            <br>
            <input type="text" name="description" class="col-md-12 form-control mb-2" placeholder="Enter description" value="{{$mainFeature->description}}">
            <br>
            <button type="submit" class=" form-control btn btn-success ">Update</button>
        </div>
    </form>
</div>
@endsection
