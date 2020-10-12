@push('styles')
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

<div class="card">
    <div class="card-header">
        <h4>Add Assignment</h4>
    </div>
    <div class="card-body" wire:ignore>
        <form action="{{ $storeUrl }}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label class="form-label">Classroom</label>
                <div class="selectgroup selectgroup-pills">
                    <label class="selectgroup-item">
                        <input type="checkbox" value="{{ $classroom->id }}" checked
                               class="selectgroup-input">
                        <span class="selectgroup-button">{{ $classroom->title }}</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{ $assignment->title }}">
            </div>

            <div class="form-group mb-4">
                <label class="">Description</label>
                <div class="">
                    <textarea class="summernote" name="description">{{ $assignment->description }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label>Deadline</label>
                <input type="text" class="form-control datetimepicker" name="deadline"
                       value="{{ $assignment->deadline }}">
            </div>

            <div class="form-group">
                <label class="form-label">Format</label>
                <div class="selectgroup selectgroup-pills">
                    @foreach($formats as $format)
                        <label class="selectgroup-item">
                            <input type="checkbox" name="formats[]" value="{{ $format }}"
                                   class="selectgroup-input" {{ in_array($format, $selectedFormats) ? 'checked' : '' }}>
                            <span class="selectgroup-button">{{ $format }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('dist/js/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('dist/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $('#assistants-select').select2();
    </script>
@endpush
