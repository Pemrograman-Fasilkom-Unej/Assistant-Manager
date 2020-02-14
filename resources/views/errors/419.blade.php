@extends('errors.layout')

@section('title', __('419 Page Expired'))
@section('content')
    <div class="text-center">
        <img src="{{ asset('assets/images/maintance/404.png') }}" alt="" class="img-fluid">
        <h5 class="text-muted my-4">Oops! Page Expired!</h5>
    </div>
@endsection
