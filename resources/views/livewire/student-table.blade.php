<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>List Students</h4>
                <div class="card-header-action">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" wire:model="search"
                               wire:keydown.enter="updatingSearch">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" wire:click="updatingSearch"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="assistant-table">
                        <thead>
                        <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Program</th>
                            <th>Year</th>
                            <th>Status</th>
                            <th>Activate Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $no => $student)
                            <tr>
                                <td>
                                    {{ $students->firstItem() + $no }}
                                </td>
                                <td>
                                    <img alt="image" src="{{ $student->profile_photo_url }}"
                                         class="rounded-circle mr-3" width="35" data-toggle="tooltip"
                                         title="{{ $student->name }}">
                                    {{ $student->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $student->username }}
                                </td>
                                <td>
                                    {{ $student->program }}
                                </td>
                                <td>
                                    {{ $student->year }}
                                </td>
                                <td>
                                    <div class="badge badge-{{ $student->isActive() ? 'success' : 'secondary' }}">
                                        {{ $student->isActive() ? 'Active' : 'Not Active' }}
                                    </div>
                                </td>
                                <td>
                                    {{ optional($student->activate_at)->format('d/m/Y h:i') ?? ' - ' }}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary">Detail</a>
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
