@extends('dashboard.admin.layouts.app')

@section('title', 'Dashboard')

@section('css')
    @include('components.style-datatables')
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Assistant</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Assistant</a></li>
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
                            <h4 class="card-title">Daftar Assisten</h4>
                            <h5 class="card-subtitle">Daftar Assisten</h5>
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">
                            <div class="dl">
                                <select class="custom-select">
                                    <option value="0" selected>Monthly</option>
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Yearly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button onclick="window.location.href = '{{ route('admin.assistant.create') }}'" class="btn btn-primary mb-2"><i class="fas fa-plus"></i>Tambah Assisten</button>
                    <div class="table-responsive">
                        <table id="assistant-table" class="table table-striped table-bordered display">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Username</th>
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
        $('#assistant-table').DataTable({
            processing: true,
            ajax: '{{ route('ajax.admin.assistant.index') }}',
            columns: [
                { data: 'no' },
                { data: 'name' },
                { data: 'nim' },
                { data: 'username' },
                { data: 'action' },
            ]
        })
    </script>
@endsection