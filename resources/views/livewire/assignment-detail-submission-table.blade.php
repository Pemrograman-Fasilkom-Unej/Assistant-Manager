<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>List Submission</h4>
                <div class="card-header-action">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" wire:model="search"
                               wire:keydown.enter="getData()">
                        <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>

                        <button class="ml-4 btn btn-info" wire:click="downloadAllSubmission">Download All</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="assistant-table">
                        <thead>
                        <tr>
                            <th class="text-center">
                                Status
                            </th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>File</th>
                            <th>Comment</th>
                            <th>Submit Date</th>
                            <th>Score</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>
                                    <div class="badge badge-{{ $student->status_badge }}">{{ $student->status }}</div>
                                </td>
                                <td>{{ $student->username }}</td>
                                <td>{{ $student->name }}</td>
                                <td>
                                    @if($student->submission)
                                        <a href="{{ $student->submission->file_url }}" class="btn btn-icon btn-primary"
                                           target="_blank">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $student->submission ? ($student->submission->comment ?? ' No Comment ') : 'Not Submitted' }}</td>
                                <td>{{ $student->submission ? ($student->submission->created_at->format('d/m/Y h:i')) : 'Not Submitted' }}</td>
                                <td>{{ $student->submission ? ($student->submission->score ?? ' - ') : 'Not Submitted' }}</td>
                                <td>
                                    @if($student->status === 'Done')
                                        <button class="btn btn-icon btn-primary score__modal-btn"
                                                data-name="{{ "$student->username - $student->name" }}"
                                                data-id="{{ $student->submission->id }}"
                                                data-score="{{ $student->submission->score ?? 0 }}">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    @elseif($student->status === 'Submitted')
                                        <button class="btn btn-icon btn-success score__modal-btn"
                                                data-name="{{ "$student->username - $student->name" }}"
                                                data-id="{{ $student->submission->id }}"
                                                data-score="{{ $student->submission->score ?? 0 }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @elseif($student->status === 'Not Submitted')
                                        <button class="btn btn-icon btn-warning">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function () {
            $('.score__modal-btn').click(function(){
                $('#modal-student-name').text($(this).data('name'));
                $('#modal-student-score').val($(this).data('score'));
                $('#modal-submission-id').val($(this).data('id'));
                $('#score-modal').modal('show');
            })
        });
    </script>
@endpush
