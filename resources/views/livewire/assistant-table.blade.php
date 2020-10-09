<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>List Assistants</h4>
                <div class="card-header-action">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" wire:model="search"
                               wire:keydown.enter="getData()">
                        <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($assistants as $no => $assistant)
                            <tr>
                                <td>
                                    {{ ($currentPage - 1) * $limit + $no + 1 }}
                                </td>
                                <td>
                                    <img alt="image" src="{{ $assistant->profile_photo_url }}"
                                         class="rounded-circle mr-3" width="35" data-toggle="tooltip"
                                         title="{{ $assistant->name }}">
                                    {{ $assistant->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $assistant->username }}
                                </td>
                                <td>
                                    {{ $assistant->program }}
                                </td>
                                <td>
                                    {{ $assistant->year }}
                                </td>
                                <td>
                                    <div class="badge badge-success">Active</div>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-secondary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
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
