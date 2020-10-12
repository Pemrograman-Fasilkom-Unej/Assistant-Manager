@push('styles')
    <link rel="stylesheet" href="{{ asset('dist/css/mdeditor.min.css') }}">
@endpush

<div class="card">
    <div class="card-header">
        <h4>Broadcast Message</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.admin.broadcast.store') }}">
            <div class="form-group">
                <textarea class="form-control" id="message-editor"></textarea>
            </div>
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
