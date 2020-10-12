@extends('layouts.app')

@section('title', 'Classroom')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Assignment</h1>
        </div>

        <div class="section-body">
            @livewire('assignment-edit-card', compact('assignment'))
        </div>
    </section>
@endsection

@push('scripts')

@endpush
