@extends('layouts.app')

@section('title', 'Settings')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Configuration of this website</h1>
        </div>

        <div class="section-body">
            @livewire('setting-component')
        </div>
    </section>
@endsection

@push('scripts')

@endpush
