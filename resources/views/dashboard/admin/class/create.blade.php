@extends('dashboard.admin.layouts.app')

@section('title', 'Dashboard')

@section('_css')
    @include('components.style-select2')
@endsection

@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">Kelas</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.class.index') }}">Daftar Kelas</a></li>
            <li class="breadcrumb-item"><a href="#!">Tambah Kelas</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambahkan Kelas</h5>
                </div>
                <div class="card-body">
                    <form class="" method="post" action="{{ route('admin.class.store') }}">
                        @csrf
                        <div class="form-group fill">
                            <label class="floating-label" for="name">Nama Kelas</label>
                            <input type="text" class="form-control" id="name" aria-describedby="Nama Kelas" placeholder="Masukan Nama Kelas" name="title" required value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <select class="js-example-basic-single form-control" id="tahun-select" name="year" required>
                                @foreach($years  as $year)
                                    <option {{ old('year') == $year ? 'selected' : '' }} value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <select class="js-example-basic-single form-control" id="semester-select" name="semester" required>
                                <option {{ old('semester') == 1 ? 'selected' : '' }} value="1">Ganjil</option>
                                <option {{ old('semester') == 2 ? 'selected' : '' }} value="2">Genap</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="assistants-option">Assisten</label>
                            <select multiple="multiple" class="js-example-basic-multiple form-control" id="assistants-option" name="assistants[]" required>
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
    @include('components.script-select2')
    <script>
        $(".js-example-basic-single").select2();
        $(".js-example-basic-multiple").select2();
    </script>
@endsection