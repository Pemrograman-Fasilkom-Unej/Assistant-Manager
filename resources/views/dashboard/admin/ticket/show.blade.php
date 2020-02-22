@extends('dashboard.admin.layouts.app')

@section('title', 'Detail Tugas')

@section('_css')
    @include('components.style-c3_chart')
@endsection

@section('css')
    @include('components.style-datatables')
    <link rel="stylesheet" href="{{ asset('dist/css/countdown.css') }}">
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Tugas - {{ $task->title }}</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.class.index') }}">Tugas</a></li>
                        <li class="breadcrumb-item">Detail Tugas - {{ $task->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Tugas {{ $task->title }}</h4>
                            <h5 class="card-subtitle">Kelas - {{ $class->title }}</h5>
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">

                        </div>
                    </div>
                    <div class="row">
                        <!-- column -->
                        <div class="col-lg-4">
                            <h1 class="mb-0 mt-4">Deadline</h1>
                            <div class="deadline-time"
                                 style="color: {{ $task->due_time < \Carbon\Carbon::now() ? 'red' : 'green' }}">

                            </div>
                            {{--<h6 class="font-light text-muted">Deadline</h6>--}}
                            <h3 class="mt-4 mb-0">Format Pengumpulan</h3>
                            <h6 class="" style="color: blue">{{ str_replace('|', ',', $task->data_types) }}</h6>

                            <h3 class="mt-4 mb-0">Token</h3>
                            <h6 class="" style="color: blue">{{ $task->token }}</h6>

                            <a class="btn btn-info mt-3 p-15 pl-4 pr-4 mb-3" href="javascript:void(0)"
                               data-toggle="modal" data-target="#share-modal">Share Link</a>
                        </div>
                        <!-- column -->
                        <div class="col-lg-8">
                            <div>
                                <canvas id="line-chart" height="150"></canvas>
                            </div>
                        </div>
                        <!-- column -->
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Info Box -->
                <!-- ============================================================== -->
                <div class="card-body border-top">
                    <div class="row mb-0">
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="mr-2">
                                    <span class="text-cyan display-5">
                                        <i class="mdi mdi-calendar"></i>
                                    </span>
                                </div>
                                <div>
                                    <span>Tanggal Pembuatan Tugas</span>
                                    <h3 class="font-medium mb-0">{{ $task->created_at->format('d/m/Y') }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="mr-2"><span class="text-cyan display-5"><i class="mdi mdi-clock"></i></span>
                                </div>
                                <div><span>Waktu Pembuatan Tugas</span>
                                    <h3 class="font-medium mb-0">{{ $task->created_at->format('H:i') }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="mr-2">
                                    <span class="text-danger display-5">
                                        <i class="mdi mdi-calendar"></i>
                                    </span>
                                </div>
                                <div><span>Tanggal Deadline Tugas</span>
                                    <h3 class="font-medium mb-0">{{ $task->due_time->format('d/m/Y') }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="mr-2">
                                    <span class="text-danger display-5">
                                        <i class="mdi mdi-clock"></i>
                                    </span>
                                </div>
                                <div><span>Waktu Deadline Tugas</span>
                                    <h3 class="font-medium mb-0">{{ $task->due_time->format('H:i') }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-xl-6">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Submission</h4>
                            <h5 class="card-subtitle">Chart Pengumpulan Tugas</h5>
                        </div>
                        <div class="ml-auto align-items-center">
                            <div class="dl">

                            </div>
                        </div>
                    </div>

                    <!-- column -->
                    <div class="row mt-5">
                        <!-- column -->
                        <div class="col-lg-6">
                            <div id="visitor" style="height:290px; width:100%;" class="mt-3"></div>
                        </div>
                        <!-- column -->
                        <div class="col-lg-6">
                            <h1 class="display-6 mb-0 font-medium">{{ number_format($submit_count / $student_count * 100, 2) }}
                                %</h1>
                            <span>Presentase Pengumpulan Tugas</span>
                            <ul class="list-style-none">
                                <li class="mt-3"><i class="fas fa-circle mr-1 text-cyan font-12"></i> Mengumpulkan
                                    <span class="float-right">{{ $submit_count }}</span>
                                </li>
                                <li class="mt-3"><i class="fas fa-circle mr-1 text-danger font-12"></i> Tidak
                                    Mengumpulkan
                                    <span class="float-right">{{ $not_submit_count }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- column -->
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-6">
            <div class="card card-hover">
                <div class="card-body"
                     style="background:url(../../assets/images/background/active-bg.png) no-repeat top center;">
                    <div class="pt-3 text-center">
                        <i class="mdi mdi-file-chart display-4 text-orange d-block"></i>
                        <span class="display-4 d-block font-medium">{{ $task->submissions->count() }}</span>
                        <span>Total Mahasiswa yang Mengumpulkan Tugas</span>
                        <!-- Progress -->
                        <div class="progress mt-5" style="height:4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 33%"
                                 aria-valuenow="{{ $task->submissions->where('score', '<>', null)->count() / $student_count * 100 }}"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 33%"
                                 aria-valuenow="{{ $task->submissions->where('score', null)->count() / $student_count * 100 }}"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 33%"
                                 aria-valuenow="{{ $not_submit_count / $student_count * 100 }}"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!-- Progress -->
                        <!-- row -->
                        <div class="row mt-4 mb-3">
                            <!-- column -->
                            <div class="col-4 border-right">
                                <h3 class="mb-0 font-medium">{{ $task->submissions->where('score', '<>', null)->count() }}</h3>
                                Sudah Dinilai
                            </div>
                            <!-- column -->
                            <div class="col-4 border-right">
                                <h3 class="mb-0 font-medium">{{ $task->submissions->where('score', null)->count() }}</h3>
                                Belum Dinilai
                            </div>

                            <div class="col-4 border-right">
                                <h3 class="mb-0 font-medium">{{ $not_submit_count }}</h3>Tidak Mengumpulkan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Submissions</h4>
                </div>
                <div class="comment-widgets scrollable" style="height:560px;">
                    <!-- Comment Row -->
                    @foreach($task->submissions->sortByDesc('created_at') as $submission)
                        <div class="d-flex flex-row comment-row mt-0">
                            <div class="p-2">
                                <img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" width="50"
                                     class="rounded-circle">
                            </div>
                            <div class="comment-text w-100">
                                <h6 class="font-medium">{{ $submission->student->name }}</h6>
                                <span class="mb-3 d-block">{{ $submission->comment ?? 'No comment' }}</span>
                                <div class="comment-footer" data-id="{{ $submission->nim }}">
                                    <span class="text-muted float-right">{{ $submission->created_at->format('F d, Y - h:i') }}</span>
                                    @if(!is_null($submission->files))
                                        <a href="{{ $submission->files }}" target="_blank">
                                            <span class="label label-rounded label-success">
                                                Download
                                            </span>
                                        </a>
                                    @endif
                                    @if(is_null($submission->score))
                                        <span class="label label-rounded label-primary pending--label">Pending</span>
                                        <span class="action-icons">
                                            <a href="javascript:void(0)" data-toggle="modal" class="add-score-btn"
                                               data-id="{{ $submission->id }}" data-target="#score-modal">
                                                <i class="ti-check"></i>
                                            </a>
                                        </span>
                                    @else
                                        <span class="label label-rounded label-success scored--label">Nilai : {{ $submission->score }}</span>
                                        <span class="action-icons">
                                            <a href="javascript:void(0)" data-toggle="modal" class="edit-score-btn"
                                               data-id="{{ $submission->id }}" data-target="#score-modal">
                                                <i class="ti-pencil-alt"></i>
                                            </a>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div id="share-modal" class="modal" role="dialog" aria-labelledby="share-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="penilaian-modal">Bagikan Tugas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h4 class="card-title">Bagikan Tugas</h4>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-link"></i></span>
                        </div>
                        <input type="text" class="form-control" value="{{ $task->url }}" id="url-input">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button" id="copy-btn">Copy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="score-modal" class="modal" role="dialog" aria-labelledby="score-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="score-form" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title" id="title--">Tambah Penilaian</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <h4 class="card-title" id="student-info"></h4>
                        @csrf
                        <input type="hidden" id="student-nim" name="nim">
                        <div class="form-group">
                            <label for="">Nilai</label>
                            <input type="number" min="0" max="100" class="form-control" name="score" id="student-score">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info waves-effect" id="score-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('components.script-datatables')
    @include('components.script-select2')
    @include('components.script-c3_chart')
    <script src="{{ asset('assets/libs/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('dist/js/countdown.js') }}"></script>
    <script>
        $(document).ready(function () {
            new Chart(document.getElementById("line-chart"), {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_keys($task_submission->toArray())) !!},
                    datasets: [{
                        data: {!! json_encode(array_values($task_submission->toArray())) !!},
                        label: "Jumlah Mahasiswa",
                        borderColor: "#07b107",
                        fill: false
                    }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Trafik pengumpulan tugas'
                    }
                }
            });

            simplyCountdown('.deadline-time', {
                year: {{ $task->due_time->format('Y') }},
                month: {{ $task->due_time->format('m') }},
                day: {{ $task->due_time->format('d') }},
                hours: {{ $task->due_time->format('H') }},
                minutes: {{ $task->due_time->format('i') }},
                seconds: {{ $task->due_time->format('s') }},
                words: {
                    days: 'Hari',
                    hours: 'Jam',
                    minutes: 'Menit',
                    seconds: 'Detik',
                },
                onEnd: () => {
                    $('.deadline-time').css('color', 'red');
                },
                plural: false,
                inline: true,
                refresh: 1000,

            });

            var chart = c3.generate({
                bindto: '#visitor',
                data: {
                    columns: [
                        ['Mengumpulkan', {{ $submit_count }}],
                        ['Tidak Mengumpulkan', {{ $not_submit_count }}],
                    ],

                    type: 'donut',
                    tooltip: {
                        show: true
                    }
                },
                donut: {
                    label: {
                        show: false
                    },
                    title: "Submission",
                    width: 50,
                },
                legend: {
                    hide: true
                    //or hide: 'data1'
                    //or hide: ['data1', 'data2']

                },
                color: {
                    pattern: ['#40c4ff', '#f62d51']
                }
            });

            $('#copy-btn').click(function () {
                $('#url-input').select();
                document.execCommand('copy');
            });

            $('.add-score-btn').click(function () {
                $('#student-score').val('');
                $.get({
                    url: '{{ url('/ajax/admin/task/student/info') }}/' + $(this).data('id'),
                    success: (r) => {
                        $('#student-info').text(r.student.name + " - " + r.nim);
                        $('#student-nim').val(r.nim);
                        $('#score-form').attr('action', '{{ route('admin.task.score.store', $task) }}')
                    }
                })
            });

            $('.edit-score-btn').click(function () {
                $.get({
                    url: '{{ url('/ajax/admin/task/student/info') }}/' + $(this).data('id'),
                    success: (r) => {
                        $('#student-info').text(r.student.name + " - " + r.nim);
                        $('#student-nim').val(r.nim);
                        $('#student-score').val(r.score);
                        $('#score-form').attr('action', '{{ route('admin.task.score.store', $task) }}')
                    }
                })
            });

            $('#score-submit').on('click', function (e) {
                e.preventDefault();
                $('#score-form').ajaxSubmit((response) => {
                    if (response.success == 0) { // IF ERROR VALIDATION
                        $.each(response.errors, (key, val) => {
                            $.each(val, (_key, _val) => {
                                toastr.error(val);
                            });
                        });
                    } else { // Its success
                        $('.comment-footer[data-id="' + response.data.nim + '"]').find('.pending--label').remove();
                        $('.comment-footer[data-id="' + response.data.nim + '"]').find('.scored--label').remove();
                        $('.comment-footer[data-id="' + response.data.nim + '"]').prepend(
                            '<span class="label label-rounded label-success scored--label">' +
                            'Nilai : ' + response.data.score +
                            '</span>'
                        );
                        toastr.success("Nilai " + response.data.nim + " berhasil dirubah");
                        $('#score-modal').modal('hide');
                    }
                })
            });
        });
    </script>
@endsection