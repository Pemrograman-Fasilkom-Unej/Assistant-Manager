<div class="modal fade" tabindex="-1" role="dialog" id="add-link-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Short a link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="long-url-input">Long URL</label>
                    <input type="text" id="long-url-input" class="form-control">
                </div>
                <div class="form-group">
                    <label>Short URL (optional)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                {{ env('SHORTLINK_URL_DISPLAY') }}
                            </div>
                        </div>
                        <input type="text" class="form-control" id="short-url-input">
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="create-link-btn">Create</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#create-link-btn').click(function (e) {

            @this.longUrl = $('#long-url-input').val();
            @this.shortUrl = $('#short-url-input').val();
            @this.submit();

            });
        });
    </script>
@endpush
