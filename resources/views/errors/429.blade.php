@extends('errors.layout')

@section('title', __('429 Too Many Request'))
@section('content')
    <div class="text-center">
        <img src="{{ asset('assets/images/maintance/404.png') }}" alt="" class="img-fluid">
        <h5 class="text-muted my-4">Oops! Too Many Request!</h5>
    </div>
@endsection
