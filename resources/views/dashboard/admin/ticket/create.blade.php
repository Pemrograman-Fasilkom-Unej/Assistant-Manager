@extends('dashboard.admin.layouts.app')

@section('title', 'Tambah Tugas')

@section('_css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/libs/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Tugas</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.class.index') }}">Tugas</a></li>
                        <li class="breadcrumb-item">Tambah Tugas - {{ $class->title }}</li>
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
                    <h4 class="card-title">Tambahkan Tugas</h4>
                    <h6 class="card-subtitle">Tambahkan Tugas ke Kelas <b>{{ $class->title }}</b></h6>
                    <form class="mt-4" method="post" action="{{ route('admin.task.store', $class) }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul Tugas</label>
                            <input type="text" class="form-control" id="name" aria-describedby="Judul Tugas"
                                   placeholder="Masukan Judul Tugas" name="title" required value="{{ old('title') }}">
                            <small id="Nama Kelas" class="form-text text-muted">Contoh : Tugas Perulangan Algo 1</small>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" rows="40">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input type="text" id="deadline" class="form-control" value="{{ old('deadline') }}" name="deadline"
                                   placeholder="{{ \Carbon\Carbon::now()->format('d F Y - h:i') }}">
                        </div>

                        <div class="form-group">
                            <label for="assistants-option">Tipe Data</label>
                            @foreach($datatypes as $index => $datatype)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input options-" value="{{ $datatype }}" id="datatype-{{ $index }}" required name="datatypes[]">
                                    <label class="custom-control-label" for="datatype-{{ $index }}">{{ $datatype }}</label>
                                </div>
                            @endforeach
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
    <script src="{{ asset('assets/libs/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#description').summernote({
                height: 300,
            });

            $('#deadline').bootstrapMaterialDatePicker({format: 'DD MMMM YYYY - HH:mm'});
        });

        $(function(){
            var requiredCheckboxes = $('.options-');
            requiredCheckboxes.change(function(){
                if(requiredCheckboxes.is(':checked')) {
                    requiredCheckboxes.removeAttr('required');
                } else {
                    requiredCheckboxes.attr('required', 'required');
                }
            });
        });
    </script>
@endsection