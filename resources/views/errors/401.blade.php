@extends('errors.layout')

@section('title', __('401 Unatorized'))
@section('content')
    <div class="text-center">
        <img src="{{ asset('assets/images/maintance/404.png') }}" alt="" class="img-fluid">
        <h5 class="text-muted my-4">Oops! Unautorized!</h5>
    </div>
@endsection
