<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Assignment List</h4>
                <div class="card-header-form">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
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
                                    {{ $index + 1 }}
                                </td>
                                <td>{{ $assignment->classroom->title }}</td>
                                <td>{{ $assignment->title }}</td>
                                <td class="align-middle">
                                    <div class="progress" data-height="4" data-toggle="tooltip" title="{{ $assignment->precentage_submission }}">
                                        <div class="progress-bar bg-info" data-width="{{ $assignment->precentage_submission }}"></div>
                                    </div>
                                </td>
                                <td>
                                    @forelse($assignment->submissions->take(3) as $submission)
                                        <img alt="image" src="{{ $submission->user->profile_photo_url }}" class="rounded-circle" width="35" data-toggle="tooltip" title="{{ $submission->user->name }}">
                                    @empty
                                        -
                                    @endforelse
                                </td>
                                <td>{{ $assignment->deadline->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="https://asdajd.asd" target="_blank">{{ $assignment->url }}</a>
                                </td>
                                <td>
                                    <div class="badge badge-{{ $assignment->isComplete() ? 'success' : 'info' }}">{{ $assignment->isComplete() ? 'Completed' : 'Active' }}</div>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary">Detail</a>
                                    <a href="#" class="btn btn-warning">Edit</a>
                                    <a href="#" class="btn btn-danger" wire:click="deleteAssignment({{ $assignment->id }})">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                @if($totalPage > 1)
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            <li class="page-item {{ $currentPage === 1 ? 'disabled' : '' }}">
                                <a wire:click="previous" class="page-link" href="#" tabindex="-1"><i
                                        class="fas fa-chevron-left"></i></a>
                            </li>
                            @for($no = $firstPage; $no <= $totalPage; $no++)
                                <li class="page-item {{ $no === $currentPage ? 'active' : '' }}"
                                    wire:click="changePage({{ $no }})">
                                    <a class="page-link" href="#">{{ $no }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ $currentPage === $totalPage ? 'disabled' : '' }}">
                                <a wire:click="next" class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>
</div>
