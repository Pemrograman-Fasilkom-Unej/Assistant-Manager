@extends('layouts.app')

@section('title', 'Classroom')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Classroom</h1>

            <div class="section-header-breadcrumb">
                <button class="btn text-right btn-primary" data-toggle="modal" data-target="#add-classroom-modal">Add
                    Classroom
                </button>
            </div>
        </div>

        <div class="section-body">
            @livewire('classroom-student-table')
        </div>
    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="add-classroom-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('dashboard.student.classroom.store') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <p>Please insert class code that given by your assistant</p>
                        <div class="form-group">
                            <label for="class-code-input">Code</label>
                            <input type="text" id="class-code-input" name="token" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
