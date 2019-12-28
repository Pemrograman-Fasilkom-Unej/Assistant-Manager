@extends('dashboard.admin.layouts.app')

@section('title', 'Tugas')

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
            <li class="breadcrumb-item"><a href="#!">Daftar Tugas</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Tugas</h5>
                    <div class="btn-group mb-2 mr-2">
                        <button class="btn btn-danger btn-sm dropdown-toggle has-ripple" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><i class="feather icon-plus"></i></span> Tambah Tugas<span class="ripple ripple-animate" style="height: 99.7813px; width: 99.7813px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -29.2657px; left: -15.1563px;"></span></button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                            @foreach($classes as $class)
                                <a class="dropdown-item" href="{{ route('admin.task.create', $class->classes) }}">{{ $class->classes->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="task-table" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Kelas</th>
                                <th>Judul</th>
                                <th>URL</th>
                                <th>Deadline</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('components.script-datatables')
    <script>
        $('#task-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: '{{ route('ajax.admin.task.index') }}',
            columns: [
                { data: 'no' },
                { data: '_class' },
                { data: 'title' },
                { data: '_url' },
                { data: '_deadline' },
                { data: 'action' },
            ]
        })
    </script>
@endsection