<div class="modal fade" tabindex="-1" role="dialog" id="score-modal" wire:ignore>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="hidden" id="modal-submission-id">
            <div class="modal-header">
                <h5 class="modal-title">Add / Change Score</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 id="modal-student-name">{{ $name }}</h4>
                <div class="form-group">
                    <label for="long-url-input">Score</label>
                    <input type="number" class="form-control" min="0" max="100" id="modal-student-score">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit-score-btn">Submit</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#submit-score-btn').click(function () {
            @this.set('submissionId', $('#modal-submission-id').val());
            @this.set('score', $('#modal-student-score').val());
            @this.assignScore();
            });
        });
        Livewire.on('assignScoreDone', r => {
            $('#score-modal').modal('hide');
            Livewire.emit('loadAssignmentData');
        })
    </script>
@endpush
