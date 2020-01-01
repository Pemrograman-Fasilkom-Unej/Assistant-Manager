@extends('dashboard.admin.layouts.app')

@section('title', 'Dashboard')

@section('css')
    @include('components.style-datatables')
@endsection

@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">Kelas</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('admin.assistant.index') }}">Daftar Assistant</a></li>
            <li class="breadcrumb-item"><a href="#!">{{ $assistant->name }}</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="mt-4"><img src="{{ asset($assistant->avatar ?? 'assets/images/users/1.jpg') }}"
                                              class="rounded-circle"
                                              width="150"/>
                        <h4 class="card-title mt-2">{{ $assistant->name }}</h4>
                        <h6 class="card-subtitle">Programming Laboratory</h6>
                        <div class="row text-center justify-content-md-center">
                        </div>
                    </center>
                </div>
                <div>
                    <hr>
                </div>
                <div class="card-body">
                    <small class="text-muted pt-4 db">Username</small>
                    <h6>{{ $assistant->username }}</h6>
                    <small class="text-muted">Email</small>
                    <h6>{{ $assistant->email }}</h6>
                    <small class="text-muted pt-4 db">NIM</small>
                    <h6>{{ $assistant->nim }}</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Tabs -->
                <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-activity-tab" data-toggle="pill" href="#activity-tab"
                           role="tab" aria-controls="pills-timeline" aria-selected="true">Timeline</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab"
                           aria-controls="pills-setting" aria-selected="false">Setting</a>
                    </li>
                </ul>
                <!-- Tabs -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="activity-tab" role="tabpanel"
                         aria-labelledby="pills-timeline-tab">
                        <div class="card-body">
                            <div class="profiletimeline mt-0">
                                @foreach($assistant->activities as $activity)
                                    <div class="sl-item">
                                        <div class="sl-left">
                                            <img src="{{ $assistant->avatar ?? asset('assets/images/users/1.jpg') }}" alt="user" class="rounded-circle"/>
                                        </div>
                                        <div class="sl-right">
                                            <div>
                                                <a href="javascript:void(0)" class="link">
                                                    {{ $assistant->name }}
                                                </a>
                                                <span class="sl-date">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</span>
                                                <p class="mt-2">{{ $activity->activity }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                        <div class="card-body">
                            <form class="form-horizontal form-material" method="post" enctype="multipart/form-data" action="{{ route('admin.assistant.update', $assistant) }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label class="col-md-12">Nama</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nama" value="{{ $assistant->name }}" name="name"
                                               class="form-control form-control-line" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">NIM</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nim" value="{{ $assistant->nim }}" name="nim"
                                               class="form-control form-control-line" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="Email" value="{{ $assistant->email  }}"
                                               class="form-control form-control-line" disabled required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">New Password</label>
                                    <div class="col-md-12">
                                        <input type="password" name="new_password" value="" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Avatar</label>
                                    <div class="col-md-12">
                                        <input type="file" name="_avatar" class="form-control form-control-line" accept="image/*">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
@endsection

@section('modals')
    <div id="penilaian-modal" class="modal" role="dialog" aria-labelledby="penilaian-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="penilaian-modal">Tambah Penilaian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="score-form">
                        <div class="form-group">
                            <label for="">Tugas</label>
                            <select class="select2 form-control custom-select" style="width: 100%; height:36px;">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Mahasiswa</label>
                            <select class="select2 form-control custom-select" style="width: 100%; height:36px;">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nilai</label>
                            <input type="number" min="0" max="100" class="form-control" name="score">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info waves-effect">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('js')
    @include('components.script-datatables')
    @include('components.script-select2')
    <script>
        $('#students-table').DataTable({
            {{--processing: true,--}}
            {{--ajax: '{{ route('ajax.admin.class.detail', $class) }}',--}}
            {{--serverSide: true,--}}
            {{--columns: [--}}
            {{--{ data: 'no' },--}}
            {{--{ data: 'nim' },--}}
            {{--{ data: '_name' },--}}
            {{--{ data: '_jumlah_tugas' },--}}
            {{--{ data: 'action' },--}}
            {{--]--}}
        })
    </script>
@endsection