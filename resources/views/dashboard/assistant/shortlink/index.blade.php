@extends('layouts.app')

@section('title', 'Shortlink')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Shortlink</h1>

            <div class="section-header-breadcrumb">
                <button class="btn btn-primary" data-toggle="modal" data-target="#add-link-modal">Add Link</button>
            </div>
        </div>

        <div class="section-body">
            @livewire('shortlink-table')
        </div>
    </section>
    @livewire('shortlink-create-modal')
@endsection

@push('scripts')

@endpush
