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
            <li class="breadcrumb-item"><a href="{{ route('admin.class.index') }}">Daftar Kelas</a></li>
            <li class="breadcrumb-item"><a href="#!">Detail Kelas - {{ $class->title }}</a></li>
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
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="student-table" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jumlah Tugas</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($class->students as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $student->student->nim }}</td>
                                    <td>{{ $student->student->name }}</td>
                                    <td>{{
                                    $student->student->submissions->map(function ($q) use ($class) {
                                        if ($q->task->class_id == $class->id) {
                                            return $q;
                                        }
                                    })->count()
                                    }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm has-ripple"
                                           href="{{ route('admin.class.student.detail', ['class' => $class, 'student' => $student->student]) }}">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
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
    @include('components.script-select2')
@endsection