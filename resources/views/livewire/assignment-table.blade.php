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
                            <th>Progress</th>
                            <th>Submission</th>
                            <th>Deadline</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($assignments as $index => $assignment)
                            <tr>
                                <td class="p-0 text-center">
                                    {{ $assignments->firstItem() + $index }}
                                </td>
                                <td>{{ $assignment->classroom->title }}</td>
                                <td>{{ $assignment->title }}</td>
                                <td class="align-middle">
                                    <div class="progress" data-height="4" data-toggle="tooltip"
                                         title="{{ $assignment->precentage_submission }}">
                                        <div class="progress-bar bg-info"
                                             data-width="{{ $assignment->precentage_submission }}"></div>
                                    </div>
                                </td>
                                <td>
                                    @forelse($assignment->submissions->take(3) as $submission)
                                        <img alt="image" src="{{ $submission->user->profile_photo_url }}"
                                             class="rounded-circle" width="35" data-toggle="tooltip"
                                             title="{{ $submission->user->name }}">
                                    @empty
                                        -
                                    @endforelse
                                </td>
                                <td>{{ $assignment->deadline->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ $assignment->url }}" target="_blank">{{ $assignment->url }}</a>
                                </td>
                                <td>
                                    <div
                                        class="badge badge-{{ $assignment->isComplete() ? 'success' : 'info' }}">{{ $assignment->isComplete() ? 'Completed' : 'Active' }}</div>
                                </td>
                                <td>
                                    <a href="{{ Auth::user()->hasRole('admin') ? route('dashboard.admin.assignment.show', $assignment) : route('dashboard.assistant.assignment.show', $assignment) }}"
                                       class="btn btn-primary">Detail</a>
                                    <a href="{{ Auth::user()->hasRole('admin') ? route('dashboard.admin.assignment.edit', $assignment) : route('dashboard.assistant.assignment.edit', $assignment) }}" class="btn btn-warning">Edit</a>
                                    <a href="#" class="btn btn-danger"
                                       wire:click="deleteAssignment({{ $assignment->id }})">Delete</a>
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
