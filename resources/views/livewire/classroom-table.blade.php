<div class="card">
    <div class="card-header">
        <h4>Classroom List</h4>
        <div class="card-header-form">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-btn">
                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>Name</th>
                    <th>Class Time</th>
                    <th>Assistant</th>
                    <th>Member Count</th>
                    <th>Assignment Count</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach($classrooms as $index => $classroom)
                    <tr>
                        <td class="p-0 text-center">
                            {{ $index + 1 }}
                        </td>
                        <td>{{ $classroom->title }}</td>
                        <td class="align-middle">
                            {{ $classroom->schedule->format('d/m/Y h:i') }} ({{ $classroom->schedule->diffForHumans() }}
                            )
                        </td>
                        <td>
                            @foreach($classroom->assistants as $assistant)
                                <img alt="image" src="{{ $assistant->profile_photo_url }}" class="rounded-circle"
                                     width="35"
                                     data-toggle="tooltip" title="{{ $assistant->name }}">
                            @endforeach
                        </td>
                        <td>{{ $classroom->members()->count() }} Students</td>
                        <td>5 Assigments</td>
                        <td>
                            <div
                                class="badge badge-{{ $classroom->isPending() ? 'warning' : ($classroom->isActive() ? 'success' : 'secondary') }}">{{ $classroom->isPending() ? 'Pending' : ($classroom->isActive() ? 'Active' : 'Inactive') }}</div>
                        </td>
                        <td>
                            @if($classroom->isPending())
                                <a href="#" class="btn btn-success" wire:click="acceptClassroom({{ $classroom->id }})">Accept</a>
                            @endif
                            <a href="#" class="btn btn-danger"
                               wire:click="deleteClassroom({{ $classroom->id }})">Delete</a>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
