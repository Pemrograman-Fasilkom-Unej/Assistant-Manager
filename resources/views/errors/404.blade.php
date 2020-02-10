@extends('errors.layout')

@section('title', __('404 Not Found'))
@section('content')
    <div class="text-center">
        <img src="{{ asset('assets/images/maintance/404.png') }}" alt="" class="img-fluid">
        <h5 class="text-muted my-4">Oops! Page not found!</h5>
    </div>
@endsection
