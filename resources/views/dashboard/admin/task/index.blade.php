@extends('dashboard.admin.layouts.app')

@section('title', 'Tugas')

@section('css')
    @include('components.style-datatables')
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Tugas</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Tugas</a></li>
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
                            <h4 class="card-title">Daftar Tugas</h4>
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">
                            <div class="dl">
                                <select class="custom-select">
                                    {{--@foreach($years as $year)--}}
                                    {{--<option value="{{ $year }}">{{ $year }}</option>--}}
                                    {{--@endforeach--}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group mb-2">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            Tambah
                        </button>
                        <div class="dropdown-menu">
                            @foreach($classes as $class)
                                <a class="dropdown-item" href="{{ route('admin.task.create', $class->classes) }}">{{ $class->classes->title }}</a>
                            @endforeach
                        </div>
                    </div>
                    {{--<button onclick="window.location.href = '{{ route('admin.task.create') }}'" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>Tambah Tugas</button>--}}
                    <div class="table-responsive">
                        <table id="task-table" class="table table-striped table-bordered display">
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