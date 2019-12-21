@extends('dashboard.admin.layouts.app')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css') }}">
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Kelas</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Buat Kelas</li>
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
                    <h4 class="card-title">Tambahkan Kelas</h4>
                    <h6 class="card-subtitle">Tambahkan Kelas Pada Semester Ini</h6>
                    <form class="mt-4" method="post" action="{{ route('admin.class.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Kelas</label>
                            <input type="text" class="form-control" id="name" aria-describedby="Nama Kelas" placeholder="Masukan Nama Kelas" name="title" required value="{{ old('title') }}">
                            <small id="Nama Kelas" class="form-text text-muted">Contoh : Algo I</small>

                        </div>
                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <select class="custom-select mr-sm-2" id="tahun-select" name="year">
                                @foreach($years  as $year)
                                    <option {{ old('year') == $year ? 'selected' : '' }} value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <select class="custom-select mr-sm-2" id="semester-select" name="semester">
                                <option {{ old('semester') == 1 ? 'selected' : '' }} value="1">Ganjil</option>
                                <option {{ old('semester') == 2 ? 'selected' : '' }} value="2">Genap</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="assistants-option">Assisten</label>
                            <select multiple="multiple" size="10" class="duallistbox" id="assistants-option" name="assistants[]" required>
                                @foreach($assistants as $assistant)
                                    <option value="{{ $assistant->id }}">{{ $assistant->name }}</option>
                                @endforeach
                            </select>
                        </div>

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
    <script src="{{ asset('assets/libs/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/forms/dual-listbox/dual-listbox.js') }}"></script>
    <script>

    </script>
@endsection