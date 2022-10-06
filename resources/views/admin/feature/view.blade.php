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
                <th>title</th>
                <th>image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            @foreach($features as $feature)
            <tr>
                <td>{{$feature->id}}</td>
                <td>{{$feature->title}}</td>
                <td><img src="{{$feature->dir}}/{{$feature->icon}}" alt="{{$feature->title}}" style="width: 50px; hight: 50px;"></td>
                <td>{{substr($feature->description ,0,60)}}...</td>
                <td> <a class="btn btn-primary" href="{{url('/admin/feature/'.$feature->id.'/edit')}}">Edit</a> <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_{{$feature->id}}">Delete</a>
                    <div class="modal fade" id="modal_{{$feature->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete {{$feature->title}} ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('features.destroy', $feature->id)}}" method="post">
                                        @csrf
                                        @method('Delete')
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>

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
