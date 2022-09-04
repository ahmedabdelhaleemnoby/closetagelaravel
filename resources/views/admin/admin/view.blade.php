@extends('admin.layout.app')
@section('content')
<div class="container mt-4">
    @if(session()->has('deleted'))
    <div class="alert alert-success">
        Admin has been successful deleted
    </div>
    @endif
    <div class="row">
        <table class="table table-success table-striped">

            <tr>
                <th>#</th>
                <th>First name</th>
                <th>Last name</th>
                <th>user name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            @foreach($admins as $admin)
            <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->fname}}</td>
                <td>{{$admin->lname}}</td>
                <td>{{$admin->username}}</td>
                <td>{{$admin->email}}</td>
                <td> <a class="btn btn-primary" href="{{url('/admin/edit/admin/'.$admin->id)}}">Edit</a> <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_{{$admin->id}}">Delete</a>
                    <div class="modal fade" id="modal_{{$admin->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete {{$admin->username}} ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a class="btn btn-danger" href="{{url('/admin/delete/admin/'.$admin->id)}}">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
