@extends('dashboard.admin.layouts.app')

@section('title', 'Dashboard')

@section('css')
    @include('components.style-datatables')
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Dashboard</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
                            <h4 class="card-title">Daftar Kelas</h4>
                            <h5 class="card-subtitle">Daftar Kelas Setiap Semester</h5>
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">
                            <div class="dl">
                                <select class="custom-select">
                                    @foreach($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button onclick="window.location.href = '{{ route('admin.class.create') }}'" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>Tambah Kelas</button>
                    <div class="table-responsive">
                        <table id="class-table" class="table table-striped table-bordered display">
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
                { data: 'no' },
                { data: 'title' },
                { data: '_year' },
                { data: '_student_count' },
                { data: '_task_count' },
                { data: 'action' },
            ]
        })
    </script>
@endsection