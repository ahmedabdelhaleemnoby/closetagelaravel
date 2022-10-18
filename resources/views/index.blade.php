@extends('layouts.app')
@if(session()->has('success'))
<div class="alert alert-success z">
    product has been successful added
</div>
@endif
@section('content')
@include('inc.slider')
@include('inc.about')
@include('inc.feature')
@include('inc.product')
@include('inc.firm')
@include('inc.review')
@include('inc.blog')

@endsection
