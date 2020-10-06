@extends('layouts.app')

@section('title', 'Assistant')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Assistant</h1>
        </div>

        <div class="section-body">
            @livewire('assistant-create-card')
        </div>
    </section>
@endsection

@push('scripts')

@endpush
