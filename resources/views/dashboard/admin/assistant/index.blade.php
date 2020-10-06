@extends('layouts.app')

@section('title', 'Assistant')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Assistant List</h1>

            <div class="section-header-breadcrumb">
                <button class="btn text-right btn-primary" onclick="window.location = '{{ route('dashboard.admin.assistant.create') }}'">Add Assistant</button>
            </div>
        </div>

        <div class="section-body">
            @livewire('assistant-table')
        </div>
    </section>
@endsection

@push('scripts')

@endpush
