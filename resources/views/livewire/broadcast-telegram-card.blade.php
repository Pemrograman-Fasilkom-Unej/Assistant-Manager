@push('styles')
    <link rel="stylesheet" href="{{ asset('dist/css/mdeditor.min.css') }}">
@endpush

<div class="card">
    <div class="card-header">
        <h4>Broadcast Message</h4>
    </div>
    <div class="card-body">
        <form action="{{ Auth::user()->hasRole('admin') ? route('dashboard.admin.broadcast.store') : route('dashboard.assistant.broadcast.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label class="form-label">Classroom</label>
                <div class="selectgroup selectgroup-pills">
                    @foreach($classrooms as $classroom)
                        <label class="selectgroup-item">
                            <input type="checkbox" name="classrooms[]" value="{{ $classroom->id }}"
                                   {{ in_array($classroom->id, old('classrooms[]') ?? []) ? 'checked' : '' }}
                                   class="selectgroup-input">
                            <span class="selectgroup-button">{{ $classroom->title }}</span>
                        </label>
                    @endforeach
                    @if(Auth::user()->hasRole('admin'))
                        <label class="selectgroup-item">
                            <input type="checkbox" name="classrooms[]" value="-1"
                                   {{ in_array('-1', old('classrooms[]') ?? []) ? 'checked' : '' }}
                                   class="selectgroup-input">
                            <span class="selectgroup-button">All Student</span>
                        </label>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="message-editor">Message</label>
                <textarea class="form-control" id="message-editor" name="messages">{{ old('messages') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Broadcast</button>
        </form>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('dist/js/mdeditor.min.js') }}"></script>
    <script>
        var md = new MdEditor('#message-editor', {
            uploader: 'http://local.dev/Lab/MdEditor/app/upload.php',
            preview: true,
            image: false
        })
    </script>
@endpush
