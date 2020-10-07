@extends('layouts.app')

@section('title', 'Student')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Student</h1>
        </div>

        <div class="section-body">
            @livewire('student-table')
        </div>
    </section>
@endsection

@push('scripts')

@endpush
