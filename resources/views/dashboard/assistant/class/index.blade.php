@extends('dashboard.assistant.layouts.app')

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
        <li class="breadcrumb-item"><a href="{{ route('assistant.dashboard') }}"><i class="feather icon-home"></i></a>
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
                <div class="row align-items-center m-l-0">
                    <div class="col-sm-6">
                        <h5>Daftar Kelas</h5>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button class="btn btn-success btn-sm has-ripple"
                          onclick="window.location.href = '{{ route('assistant.class.create') }}'"><span><i
                                  class="feather icon-plus"></i></span>Tambah Kelas
                        </button>
                    </div>
                </div>
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

<form action="{{ route('assistant.class.enable') }}" method="post" id="enable-form">
    @csrf
    <input type="hidden" id="enable-class-id" name="id">
</form>

<form action="{{ route('assistant.class.disable') }}" method="post" id="disable-form">
    @csrf
    <input type="hidden" id="disable-class-id" name="id">
</form>
@endsection

@section('js')
@include('components.script-datatables')
<script>
    $('#class-table').DataTable({
            processing: true,
            ajax: '{{ route('ajax.assistant.class.index') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, sortable: false },
                {data: 'title'},
                {data: '_year'},
                {data: '_student_count'},
                {data: '_task_count'},
                {data: 'action'},
            ]
        });

        function enableClass(id) {
            $('#enable-class-id').val(id);
            $('#enable-form').submit();
        }

        function disableClass(id) {
            $('#disable-class-id').val(id);
            $('#disable-form').submit();
        }
</script>

@endsection