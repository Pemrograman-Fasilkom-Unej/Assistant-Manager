@extends('dashboard.assistant.layouts.app')

    @section('title', 'Kelas ' . $class->name)

@section('css')

@endsection

@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">Kelas</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('assistant.dashboard') }}"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('assistant.class.index') }}">Daftar Kelas</a></li>
            <li class="breadcrumb-item"><a href="{{ route('assistant.class.show', $class) }}">Detail Kelas - {{ $class->title }}</a></li>
            <li class="breadcrumb-item"><a href="#!">{{ $student->name }}</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card card-hover">
                <div class="card-body"
                     style="background:url(../../assets/images/background/active-bg.png) no-repeat top center;">
                    <div class="pt-3 text-center">
                        <i class="mdi mdi-file-chart display-4 text-orange d-block"></i>
                        <h3>{{ $student->name }}</h3>
                        <span>{{ $student->nim }}</span>
                        <div class="progress mt-5" style="height:4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 33%"
                                 aria-valuenow="33"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 33%"
                                 aria-valuenow="33"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 33%"
                                 aria-valuenow="33"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!-- row -->
                        <div class="row mt-4 mb-3">
                            <!-- column -->
                            <div class="col-4 border-right">
                                <h3 class="mb-0 font-medium">{{ $submissions->count() }}</h3>
                                Jumlah Tugas Terkumpulkan
                            </div>
                            <!-- column -->
                            <div class="col-4 border-right">
                                <h3 class="mb-0 font-medium">{{ $submissions->max('score') ?? 0 }}</h3>
                                Nilai Tertinggi Dari Tugas
                            </div>

                            <div class="col-4 border-right">
                                <h3 class="mb-0 font-medium">{{ $unsubmited_tasks->count() }}</h3>Tugas Tidak
                                Terkumpulkan
                            </div>
                        </div>
                        <br><br>
                        {!! $unsubmited_tasks->count() > 0 ? '<h5>List Tugas Tidak Terkumpulkan</h5>' : '' !!}
                        <ul class="list-unstyled">
                            @forelse ($unsubmited_tasks as $task)
                            <li class="mb-1">
                                <a href="{{ route('assistant.task.show', $task) }}">{{ $task->title }}</a>
                            </li>
                            @empty
                                <h5>Semua Tugas Terkumpulkan</h5>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Tugas Mahasiswa di {{ $class->title }}</h5>
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        @if ($submissions->isNotEmpty())
                            <table id="student-table" class="table table-striped table-bordered nowrap">
                                <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>Nama Tugas</th>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($submissions as $submission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $submission->task->title }}</td>
                                        <td>{{ $submission->score }}</td>
                                        <td>{{ $submission->comment }}</td>
                                        <td>
                                            @if(!is_null($submission->files ))
                                                <a href="{{ route('assistant.task.submission.download', $submission) }}" target="_blank" class="btn btn-success btn-sm has-ripple">
                                                    Download
                                                </a>
                                            @else
                                                No File
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('assistant.task.show', $submission->task) }}"
                                            class="btn btn-info btn-sm has-ripple">Tugas</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Belum ada tugas yang pernah disubmit.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
@endsection

@section('js')
    @include('components.script-select2')
@endsection