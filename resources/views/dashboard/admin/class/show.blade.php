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
                    <div class="row align-items-center m-l-0">
                        <div class="col-sm-6">
                            <h5>Daftar Mahasiswa di {{ $class->title }}</h5>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-success btn-sm btn-round has-ripple" data-toggle="modal" data-target="#modal-add-student"><i class="feather icon-plus"></i> Tambah Mahasiswa<span class="ripple ripple-animate" style="height: 144.797px; width: 144.797px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -58.3985px; left: -28.6016px;"></span></button>
                        </div>
                    </div>
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

@section('modals')
    <div id="modal-add-student" class="modal fade" role="dialog" aria-labelledby="modal-add-student" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.class.add-student', $class) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="assistants-option">Daftar Mahasiswa</label>
                            <textarea class="form-control" rows="3" name="students" placeholder="List Nim">{{ old('students') }}</textarea>
                            <small id="textHelp" class="form-text text-muted">List NIM pada kelas tersebut dipisahkan oleh baris baru</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('components.script-datatables')
    @include('components.script-select2')
@endsection