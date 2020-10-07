@extends('layouts.app')

@section('title', 'Classroom')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Classroom</h1>

            <div class="section-header-breadcrumb">
                <button class="btn text-right btn-primary" onclick="window.location = '{{ route('dashboard.admin.classroom.create') }}'">Add Classroom</button>
            </div>
        </div>

        <div class="section-body">
            @livewire('classroom-table')
        </div>
    </section>
@endsection

@push('scripts')

@endpush