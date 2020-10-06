@extends('layouts.app')

@section('title', 'Classroom')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Classroom</h1>
        </div>

        <div class="section-body">
            @livewire('classroom-create-card')
        </div>
    </section>
@endsection

@push('scripts')

@endpush
