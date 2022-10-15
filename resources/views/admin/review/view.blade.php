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
                <th>title job</th>
                <th>Action</th>
            </tr>
            @foreach($reviews as $review)
            <tr>
                <td>{{$review->id}}</td>
                <td>{{$review->title}}</td>
                <td><img src="{{$review->dir}}/{{$review->image}}" alt="{{$review->title}}" style="width: 50px; height: 50px;"></td>
                <td>{{substr($review->description ,0,60)}}...</td>
                <td>{{$review->title_job}}</td>
                <td> <a class="btn btn-primary" href="{{url('/admin/review/'.$review->id.'/edit')}}">Edit</a> <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_{{$review->id}}">Delete</a>
                    <div class="modal fade" id="modal_{{$review->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete {{$review->title}} ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('reviews.destroy', $review->id)}}" method="post">
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
