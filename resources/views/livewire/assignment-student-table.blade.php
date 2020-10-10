<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Assignment List</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" wire:model="search"
                               wire:keydown.enter="updatingSearch">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" wire:click="updatingSearch"><i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>
                                #
                            </th>
                            <th>Classroom</th>
                            <th>Title</th>
                            <th>Deadline</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($assignments as $index => $assignment)
                            <tr>
                                @php($status = $assignment->submissionStatus(Auth::id()))
                                <td class="p-0 text-center">
                                    {{ $assignments->firstItem() + $index }}
                                </td>
                                <td>{{ $assignment->classroom->title }}</td>
                                <td>{{ $assignment->title }}</td>
                                <td>
                                    <div class="badge badge-{{ $assignment->isComplete() ? 'success' : 'info' }}">
                                        {{ $assignment->deadline->format('d F Y H:i') }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ $assignment->url }}" target="_blank">{{ $assignment->url }}</a>
                                </td>
                                <td>
                                    <div class="badge badge-{{ $status['badge'] }}">
                                        {{ $status['value'] }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.student.assignment.show', $assignment) }}"
                                       class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                {{ $assignments->links() }}
            </div>
        </div>
    </div>
</div>
