@extends('layouts.app')

@section('title', 'Assignment')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Assignments</h1>
        </div>

        <div class="section-body">
            @livewire('assignment-student-table')
        </div>
    </section>
@endsection

@push('scripts')

@endpush
