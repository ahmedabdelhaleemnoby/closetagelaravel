@extends('admin.layout.app')
@section('content')
<div class="container d-flex flex-column">

    <div class="row">
        <h1 class="text-success mt-4 mb-4">Add Admin</h1>
    </div>
    <form action="{{url('/admin/add/admin')}}" method="post" class="p-8 ">
        @csrf
        <div class="row">
            <!-- <input type="text" class="col-md-12 form-control mb-2"> -->
            @if(session()->has('success'))
            <div class="alert alert-success">
                Admin has been successful added
            </div>
            @endif
            @if($errors->first())
            <div class="alert alert-danger">
                {{$errors->first()}}
            </div>
            @endif
        </div>

        <div class="row">
            <input type="text" name="fname" class="col-md-8 form-control mb-2" placeholder="Enter First Name">
            <br>
            <input type="text" name="lname" class="col-md-8 form-control mb-2" placeholder="Enter Last Name">
            <br>
            <input type="text" name="username" class="col-md-8 form-control mb-2" placeholder="Enter Username">
            <br>
            <input type="text" name="email" class="col-md-8 form-control mb-2" placeholder="Enter email">
            <br>
            <input type="password" name="password" class="col-md-8 form-control mb-2" placeholder="Enter password">
            <br>
            <input type="password" name="cpassword" class="col-md-8 form-control mb-2" placeholder="confirm password">
            <br>
            <button type="submit" class="btn btn-success col-md-5 mb-2">Add</button>
        </div>
    </form>
</div>
@endsection
