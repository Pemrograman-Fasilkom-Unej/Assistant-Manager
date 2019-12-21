@extends('dashboard.admin.layouts.app')

@section('title', 'Dashboard')

@section('css')
    @include('components.style-datatables')
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Kelas</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.class.index') }}">Kelas</a></li>
                        <li class="breadcrumb-item">Detail Kelas - {{ $class->title }}</li>
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
                            <h4 class="card-title">Detail Kelas</h4>
                            <h5 class="card-subtitle">Detail Kelas - {{ $class->title }}</h5>
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">

                        </div>
                    </div>
{{--                    <button data-toggle="modal" data-target="#penilaian-modal" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>Tambah Penilaian</button>--}}
                    <div class="table-responsive">
                        <table id="students-table" class="table table-striped table-bordered display">
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

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                                @foreach($class->tasks->sortByDesc('created_at') as $task)
                                    <option value="{{ $task->id }}">{{ $task->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Mahasiswa</label>
                            <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                @foreach($class->students as $student)
                                    <option value="{{ $student->student->nim }}">{{ $student->student->nim }} - {{ $student->student->name }}</option>
                                @endforeach
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
            processing: true,
            ajax: '{{ route('ajax.admin.class.detail', $class) }}',
            serverSide: true,
            columns: [
                { data: 'no' },
                { data: 'nim' },
                { data: '_name' },
                { data: '_jumlah_tugas' },
                { data: 'action' },
            ]
        })
    </script>
@endsection