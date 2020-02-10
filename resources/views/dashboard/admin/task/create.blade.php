@extends('dashboard.admin.layouts.app')

@section('title', 'Tambah Tugas')

@section('_css')
    <link rel="stylesheet" href="{{ asset('assets/css/summernote-bs4.min.css') }}">
@endsection

@section('css')

@endsection

@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">Kelas</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('admin.task.index') }}">Tugas</a></li>
            <li class="breadcrumb-item"><a href="#!">Tambah Tugas</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambahkan Tugas</h5>
                </div>
                <div class="card-body">
                    <form class="" method="post" action="{{ route('admin.task.store', $class) }}">
                        @csrf
                        <div class="form-group fill">
                            <label class="floating-label" for="name">Nama Tugas</label>
                            <input type="text" class="form-control" id="name" aria-describedby="Nama Tugas"
                                   placeholder="Masukan Nama Tugas" name="title" required value="{{ old('title') }}">
                        </div>
                        <div class="form-group fill">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input type="text" id="deadline" class="form-control" value="{{ old('deadline') }}"
                                   name="deadline"
                                   placeholder="{{ \Carbon\Carbon::now()->format('d F Y - h:i') }}">
                        </div>

                        <div class="form-group">
                            <label for="assistants-option">Tipe Data</label>
                            @foreach($datatypes as $index => $datatype)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input options-" value="{{ $datatype }}"
                                           id="datatype-{{ $index }}" required name="datatypes[]">
                                    <label class="custom-control-label"
                                           for="datatype-{{ $index }}">{{ $datatype }}</label>
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
    <script src="{{ asset('assets/js/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'https://api.github.com/emojis',
                async: false
            }).then(function(data) {
                window.emojis = Object.keys(data);
                window.emojiUrls = data;
            });

            $('#description').summernote({
                height: 250,
                codeviewFilter: false,
                codeviewIframeFilter: true,
                hint: {
                    match: /:([\-+\w]+)$/,
                    search: function (keyword, callback) {
                        callback($.grep(emojis, function (item) {
                            return item.indexOf(keyword)  === 0;
                        }));
                    },
                    template: function (item) {
                        var content = emojiUrls[item];
                        return '<img src="' + content + '" width="20" /> :' + item + ':';
                    },
                    content: function (item) {
                        var url = emojiUrls[item];
                        if (url) {
                            return $('<img />').attr('src', url).css('width', 20)[0];
                        }
                        return '';
                    },
                    callbacks: {
                        onImageUpload: function(files){
                            console.log(files);
                        }
                    }
                }
            });
        });

        $(function () {
            var requiredCheckboxes = $('.options-');
            requiredCheckboxes.change(function () {
                if (requiredCheckboxes.is(':checked')) {
                    requiredCheckboxes.removeAttr('required');
                } else {
                    requiredCheckboxes.attr('required', 'required');
                }
            });
        });
    </script>
@endsection