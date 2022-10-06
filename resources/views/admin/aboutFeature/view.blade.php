@extends('admin.layout.app')
@section('content')
<div class="container mt-4">
    @if(session()->has('deleted'))
    <div class="alert alert-success">
        Admin has been successful deleted
    </div>
    @endif
    <div><a class="btn btn-success" href="{{url("/admin/about/$request->id/features/create")}}">Add feature</a></div><br>
    <div class="row">

        <table class="table table-success table-striped">

            <tr>
                <th>#</th>
                <th>about</th>
                <th>feature</th>
                <th>Action</th>
            </tr>
            @foreach($aboutfeatures as $aboutfeature)
            <tr>
                <td>{{$aboutfeature->id}}</td>
                <td>{{$aboutfeature->about}}</td>
                <td>{{$aboutfeature->feature}}</td>
                <td> <a class="btn btn-primary" href="{{url('/admin/about/'.$aboutfeature->id.'/edit')}}">Edit</a> <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_{{$aboutfeature->id}}">Delete</a>
                    <div class="modal fade" id="modal_{{$aboutfeature->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete {{$aboutfeature->title}} ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('about.destroy', $aboutfeature->id)}}" method="post">
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
