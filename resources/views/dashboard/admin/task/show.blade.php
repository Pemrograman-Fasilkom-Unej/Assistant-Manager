@extends('dashboard.admin.layouts.app')

@section('title', 'Detail Tugas')

@section('_css')

@endsection

@section('css')
    @include('components.style-datatables')
    <link rel="stylesheet" href="{{ asset('dist/css/countdown.css') }}">
    <style>
        .btn-icon {
            width: 25px !important;
            height: 25px !important;
            font-size: 15px !important;
        }
    </style>
@endsection

@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">Kelas</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('admin.task.index') }}">Daftar Tugas</a></li>
            <li class="breadcrumb-item"><a href="#!">Detail Tugas - {{ $task->title }}</a></li>
        </ul>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body bg-c-green" id="timer-body">
                    <div class="counter text-center">
                        <h4 id="timer" class="text-white m-0"></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 task-detail-right">
            <div class="card">
                <div class="card-header">
                    <h5>Tugas - {{ $task->title }}</h5>
                    <p class="text-c-red"><b>{{ $task->token }}</b></p>
                </div>
                <div class="card-body task-details">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><i class="far fa-calendar-alt"></i> Dibuat :</td>
                            <td class="text-right">{{ $task->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td><i class="far fa-clock"></i> Dibuat :</td>
                            <td class="text-right">{{ $task->created_at->format('H:i:s') }}</td>
                        </tr>
                        <tr>
                            <td><i class="far fa-calendar-times"></i> Deadline:</td>
                            <td class="text-right">{{ $task->due_time->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td><i class="far fa-clock"></i> Deadline:</td>
                            <td class="text-right">{{ $task->due_time->format('H:i:s') }}</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file"></i> Format Pengumpulan:</td>
                            <td class="text-right">
                                @foreach(explode('|', $task->data_types) as $type)
                                    <label class="badge badge-light-primary">{{ $type }}</label>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-link"></i> Link:</td>
                            <td class="text-right">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#share-modal">Show</button>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-plus"></i> Edit:</td>
                            <td class="text-right">
                                <a class="btn btn-sm btn-info text-white" href="{{ route('admin.task.edit', $task) }}">Edit</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-xl-8 col-lg-12">
            <div class="card support-bar overflow-hidden">
                <div class="card-header">
                    <h2 class="m-0">Tugas {{ $task->title }}</h2>
                    <a href="{{ route('admin.class.show', $task->classes) }}"><span
                                class="text-c-blue">{{ $task->classes->title }}</span></a>
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <!-- column -->
                        <div class="col-lg-12">
                            <div id="line-chart">

                            </div>
                        </div>
                        <!-- column -->
                    </div>
                </div>
                <div class="card-footer bg-primary text-white">
                    <div class="row text-center">
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $task->created_at->format('d/m/Y') }}</h4>
                            <span>Tanggal Pembuatan Tugas</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $task->created_at->format('H:i') }}</h4>
                            <span>Waktu Pembuatan Tugas</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $task->due_time->format('d/m/Y') }}</h4>
                            <span>Tanggal Deadline Tugas</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $task->due_time->format('H:i') }}</h4>
                            <span>Waktu Deadline Tugas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <div class="card support-bar overflow-hidden">
                <div class="card-header">
                    <h2 class="m-0">Submission</h2>
                    <span class="text-c-blue">Chart Pengumpulan Tugas</span>
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <!-- column -->
                        <div id="pie-chart-submission" class="mt-2 mb-4" style="width:100%"></div>
                        <!-- column -->
                    </div>
                </div>

                <div class="card-footer bg-info text-white">
                    <div class="row text-center">
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $not_submit_count }}</h4>
                            <span>Tidak Mengumpulkan</span>
                        </div>
                        <div class="col">
                            <h4 class="m-0 text-white">{{ $submit_count }}</h4>
                            <span>Mengumpulkan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="card bg-c-yellow text-white widget-visitor-card">
                <div class="card-body text-center">
                    <h2 class="text-white">{{ $task->submissions->count() === 0 ? 0 : $task->submissions->sortByDesc('score')->first()->score }}</h2>
                    <h6 class="text-white">Nilai Tertinggi</h6>
                    <i class="feather icon-bar-chart"></i>
                </div>
            </div>
            <div class="card bg-c-blue text-white widget-visitor-card">
                <div class="card-body text-center">
                    <h2 class="text-white">{{ $task->submissions->avg('score') }}</h2>
                    <h6 class="text-white">Nilai Rata-Rata</h6>
                    <i class="feather icon-award"></i>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <h4>Penilaian</h4>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <h3 class="m-0">
                                <i class="fas fa-circle text-success f-10 m-r-5"></i>{{ $task->submissions->count() === 0 ? 0 : $task->submissions->where('score', '<>', null)->count() / $submit_count * 100 }}%
                            </h3>
                            <span class="ml-3">Sudah Dinilai</span>
                        </div>
                        <div class="col">
                            <h3 class="m-0"><i
                                        class="fas fa-circle text-danger f-10 m-r-5"></i>{{ $task->submissions->count() === 0 ? 0 : $task->submissions->where('score', null)->count() / $submit_count * 100 }}
                                %</h3>
                            <span class="ml-3">Belum Dinilai</span>
                        </div>
                    </div>
                    <div class="progress mt-4" style="height:8px;">
                        <div class="progress-bar bg-success rounded mr-1" role="progressbar"
                             style="width: {{ $task->submissions->count() === 0 ? 0 : $task->submissions->where('score', '<>', null)->count() / $submit_count * 100 }}%;"
                             aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        <div class="progress-bar bg-danger rounded" role="progressbar"
                             style="width: {{ $task->submissions->count() === 0 ? 0 : $task->submissions->where('score', null)->count() / $submit_count * 100 }}%;"
                             aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="user-list-table" class="table">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>File</th>
                                <th>Comment</th>
                                <th>Tanggal Submit</th>
                                <th>Nilai</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($task->submissions->sortByDesc('created_at') as $submission)
                                <tr>
                                    <td data-order="{{ !is_null($submission->score) ? 1 : 0 }}">
                                        @if(!is_null($submission->score))
                                            <span class="badge badge-light-success">Done</span>
                                        @else
                                            <span class="badge badge-light-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-inline-block align-middle">
                                            <div class="d-inline-block">
                                                <h6 class="m-b-0">{{ $submission->student->nim }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-inline-block align-middle">
                                            <div class="d-inline-block">
                                                <h6 class="m-b-0">{{ $submission->student->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if(!is_null($submission->files))
                                            <div class="overlay-edit">

                                                <a href="{{ route('admin.task.submission.download', $submission) }}" target="_blank"
                                                   class="btn btn-sm btn-icon btn-success">
                                                    <i class="feather icon-download"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $submission->comment ?? 'No comment' }}</td>
                                    <td data-order="{{ $submission->created_at }}">{{ $submission->created_at->format('F d Y') }}</td>
                                    <td>{{ $submission->score ?? ' - ' }}</td>
                                    <td>
                                        @if(is_null($submission->score))
                                            <div class="overlay-edit">
                                                <button type="button" class="btn btn-sm btn-icon btn-success add-score-btn" data-toggle="modal"
                                                        data-id="{{ $submission->id }}" data-target="#score-modal">
                                                    <i class="feather icon-check-circle"></i>
                                                </button>
                                            </div>
                                        @else
                                            <div class="overlay-edit">
                                                <button type="button" class="btn btn-sm btn-icon btn-primary edit-score-btn" data-toggle="modal"
                                                        data-id="{{ $submission->id }}" data-target="#score-modal">
                                                    <i class="feather icon-edit"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div id="share-modal" class="modal fade" role="dialog" aria-labelledby="share-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Bagikan Tugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
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

    <div id="score-modal" class="modal fade" role="dialog" aria-labelledby="score-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                        <button type="button" class="btn btn-primary waves-effect" id="score-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('components.script-datatables')
    @include('components.script-select2')
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dist/js/countdown.js') }}"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script>
        $(document).ready(function () {
            $(function () {
                var options = {
                    chart: {
                        height: 300,
                        type: 'line',
                        zoom: {
                            enabled: false
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: [5],
                        curve: 'straight',
                        dashArray: [0]
                    },
                    colors: ["#0e9e4a"],
                    series: [{
                        name: "Jumlah Pengumpulan",
                        data: {!! json_encode(array_values($task_submission->toArray())) !!}
                    }],
                    title: {
                        text: 'Submission Statistic',
                        align: 'left'
                    },
                    markers: {
                        size: 0,

                        hover: {
                            sizeOffset: 6
                        }
                    },
                    xaxis: {
                        categories: {!! json_encode(array_keys($task_submission->toArray())) !!},
                    },
                    tooltip: {
                        y: [{
                            title: {
                                formatter: function (val) {
                                    return val + " (mahasiswa)"
                                }
                            }
                        }]
                    },
                    grid: {
                        borderColor: '#f1f1f1',
                    }
                };
                var chart = new ApexCharts(
                    document.querySelector("#line-chart"),
                    options
                );
                chart.render();
            });

            $(function () {
                var options = {
                    chart: {
                        height: 320,
                        type: 'pie',
                    },
                    labels: ['Mengumpulkan', 'Tidak Mengumpulkan'],
                    series: [{{ $submit_count }}, {{ $not_submit_count }}],
                    colors: ["#0e9e4a", "#f62d51"],
                    legend: {
                        show: true,
                        position: 'bottom',
                    },
                    dataLabels: {
                        enabled: true,
                        dropShadow: {
                            enabled: false,
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };
                var chart = new ApexCharts(
                    document.querySelector("#pie-chart-submission"),
                    options
                );
                chart.render();
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
                                showNotification(val, "error");
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
                        showNotification("Nilai " + response.data.nim + " berhasil dirubah", "success");
                        $('#score-modal').modal('hide');
                    }
                })
            });

            $('#user-list-table').DataTable({
                order: [[5, 'desc']]
            })
        });
    </script>

    <script>
        // Set the date we're counting down to
        var d = new Date("{{ $task->due_time }}");
        var countDownDate = new Date(d).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("timer").innerHTML = "<b>" + days + "</b>Hari : <b>" + hours + "</b>Jam : <b>" +
                minutes + "</b>Menit : <b>" + seconds + "</b>Detik ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                $('#timer').text("Waktu Habis");
                $('#timer-body').removeClass('bg-c-green').addClass('bg-c-red');
            }
        }, 1000);
    </script>
@endsection