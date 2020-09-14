@extends('dashboard.assistant.layouts.app')

@section('title', 'Edit Tugas')

@section('_css')
    <link rel="stylesheet" href="{{ asset('assets/css/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/daterangepicker.css') }}">
@endsection

@section('css')

@endsection

@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">Kelas</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('assistant.dashboard') }}"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('assistant.task.index') }}">Tugas</a></li>
            <li class="breadcrumb-item"><a href="{{ route('assistant.task.show', $task) }}">Detail - {{ $task->title }}</a></li>
            <li class="breadcrumb-item"><a href="#!">Edit</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit: {{ $task->title }}</h5>
                </div>
                <div class="card-body">
                    <form id="form_task" method="post" action="{{ route('assistant.task.update', $task) }}">
                        @csrf
                        @method('put')
                        <div class="d-none">
                            <label class="floating-label" for="name">Nama Tugas</label>
                            <input type="hidden" class="form-control" id="name" aria-describedby="Nama Tugas"
                                   placeholder="Masukan Nama Tugas" name="title" required value="{{ old('title', $task->title) }}">
                        </div>
                        <div class="form-group fill">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description">{{ $task->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input type="text" id="deadline" class="form-control" value="{{ $task->due_time->format('Y-m-d h:i A') }}"
                                   name="deadline"
                                   placeholder="{{ $task->due_time->format('Y-F-d h:i A') }}">
                        </div>

                        <div class="form-group">
                            <label for="assistants-option">Tipe Data</label>
                            @php($types = explode('|', $task->data_types))
                            @foreach($datatypes as $index => $datatype)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input options-" value="{{ $datatype }}" {{ in_array($datatype, $types) ? 'checked' : ''}}
                                           id="datatype-{{ $index }}" name="datatypes[]">
                                    <label class="custom-control-label"
                                           for="datatype-{{ $index }}">{{ $datatype }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" id="btn_preview" class="btn btn-info">Preview <i class="fa fa-eye"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/daterangepicker.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('#btn_preview').on('click', function () {
                $('input[name="_method"]').remove();
                $('#form_task')
                    .attr('target', '_blank')
                    .attr('action', '{{ route('assistant.task.preview') }}')
                    .submit();

                // Revert
                $('#form_task').append(`@method('put')`);
                $('#form_task')
                    .attr('action', '{{ route('assistant.task.update', $task) }}')
                    .removeAttr('target');
            });

            $('input[name="deadline"]').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'Y-M-D h:mm A'
                },
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10)
            });

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
