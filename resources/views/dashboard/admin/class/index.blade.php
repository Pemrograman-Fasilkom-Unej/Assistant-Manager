@extends('dashboard.admin.layouts.app')

@section('title', 'Dashboard')

@section('_css')
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
            <li class="breadcrumb-item"><a href="#!">Daftar Kelas</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- Zero config table start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Kelas</h5>
                    <button class="btn btn-success btn-sm has-ripple" onclick="window.location.href = '{{ route('admin.class.create') }}'"><span><i class="feather icon-plus"></i></span>Tambah Kelas</button>
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="class-table" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Kelas</th>
                                <th>Tahun / Semester</th>
                                <th>Jumlah Mahasiswa</th>
                                <th>Jumlah Tugas</th>
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
        $('#class-table').DataTable({
            processing: true,
            ajax: '{{ route('ajax.admin.class.index') }}',
            columns: [
                {data: 'no'},
                {data: 'title'},
                {data: '_year'},
                {data: '_student_count'},
                {data: '_task_count'},
                {data: 'action'},
            ]
        })
    </script>
@endsection