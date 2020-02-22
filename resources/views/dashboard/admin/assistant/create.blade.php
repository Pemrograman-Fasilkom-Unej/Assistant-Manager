@extends('dashboard.admin.layouts.app')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css') }}">
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
            <li class="breadcrumb-item"><a href="#!">Tambah Asisten</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambahkan Asisten</h4>
                    <h6 class="card-subtitle">Tambahkan Kelas Pada Semester Ini</h6>
                    <form class="mt-4" method="post" action="{{ route('admin.assistant.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" aria-describedby="Nama" placeholder="Masukan Nama Asisten" name="name" required value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" id="nim" aria-describedby="NIM" placeholder="Masukan NIM Asisten" name="nim" required maxlength="15" value="{{ old('nim') }}">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" aria-describedby="Username" placeholder="Masukan Username Asisten" name="username" required value="{{ old('username') }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="Email" placeholder="Masukan Email Asisten" name="email" required value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" aria-describedby="NIM" placeholder="Masukan Password Asisten" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/libs/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/forms/dual-listbox/dual-listbox.js') }}"></script>
    <script>

    </script>
@endsection