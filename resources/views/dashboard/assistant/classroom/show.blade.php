@extends('layouts.app')

@section('title', 'Classroom')

@push('styles')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $classroom->title }}</h1>

            <div class="section-header-breadcrumb">
                <button class="btn text-right btn-primary" onclick="window.location = '{{ route('dashboard.assistant.assignment.create') }}'">Add Assignment</button>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card" style="height: 420px">
                        <div class="card-header">
                            <h4>Assistants</h4>
                        </div>
                        <div class="card-body overflow-auto">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach($classroom->assistants as $assistant)
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50"
                                             src="{{ $assistant->profile_photo_url }}" alt="avatar">
                                        <div class="media-body">
                                            <div class="media-title">{{ $assistant->name }}</div>
                                            <span
                                                class="text-small text-muted">{{ $assistant->program }} | {{ $assistant->username }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 col-12 col-sm-12 h-auto">
                    <div class="card" style="height: 420px">
                        <div class="card-body overflow-auto">
                            <table class="table table-bordered text-primary">
                                <tr>
                                    <td>Year / Semester</td>
                                    <td>{{ $classroom->year }} / {{ $classroom->season }}</td>
                                </tr>
                                <tr>
                                    <td>Token / Code</td>
                                    <td>{{ $classroom->token }}</td>
                                </tr>
                                <tr>
                                    <td>Next Schedule</td>
                                    <td>{{ $classroom->schedule->format('d F Y - H:i') }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <div
                                            class="badge badge-{{ $classroom->isPending() ? 'warning' : ($classroom->isActive() ? 'success' : 'secondary') }}">
                                            {{ $classroom->isPending() ? 'Pending' : ($classroom->isActive() ? 'Active' : 'Inactive') }}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Student</td>
                                    <td>{{ $classroom->members()->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Total Assignment</td>
                                    <td>{{ $classroom->assignments()->count() }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $classroom->accepted_at->format('d F Y - H:i') }}</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7 col-md-12 col-12 col-sm-12">
                    <div class="card" style="height: 500px">
                        <div class="card-header">
                            <h4>Assignments</h4>
                        </div>
                        <div class="card-body overflow-auto">
                            <table class="table table-bordered text-primary">
                                @forelse($classroom->assignments->sortByDesc('deadline') as $assignment)
                                    <tr>
                                        <td>{{ $assignment->title }}</td>
                                        <td>{{ $assignment->deadline->format('d F Y - H:i') }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.student.assignment.show', $assignment) }}" class="btn btn-primary">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>There is no Task yet</tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12 col-12 col-sm-12">
                    <div class="card" style="height: 500px">
                        <div class="card-header">
                            <h4>Students</h4>
                        </div>
                        <div class="card-body overflow-auto">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach($classroom->members->sortBy('username') as $student)
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50"
                                             src="{{ $student->profile_photo_url }}" alt="avatar">
                                        <div class="media-body">
                                            <div class="media-title">{{ $student->name }}</div>
                                            <span
                                                class="text-small text-muted">{{ $student->program }} | {{ $student->username }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush
