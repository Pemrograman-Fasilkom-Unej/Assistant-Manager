<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>List Students</h4>
                <div class="card-header-action">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" wire:model="search" wire:keydown.enter="getLinks">
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
                            <th>Short URL</th>
                            <th>Long URL</th>
                            <th>Visit Count</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($links as $no => $link)
                            <tr>
                                <td>
                                    {{ $itemsPerPage * ($pageNumber - 1) + $no + 1 }}
                                </td>
                                <td>
                                    <a href="{{ env('SHORTLINK_URL_DISPLAY') . $link['short_url'] }}" target="_blank">
                                        {{ env('SHORTLINK_URL_DISPLAY') . $link['short_url'] }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ $link['long_url'] }}" target="_blank">
                                        {{ $link['long_url'] }}
                                    </a>
                                </td>
                                <td>
                                    {{ $link['visit_count'] }}
                                </td>
                                <td>
                                    {{ \Illuminate\Support\Carbon::parse($link['created_at'])->format('d/m/Y h:i') }}
                                </td>
                                <td>
                                    <button class="btn btn-danger" wire:click="deleteLink('{{ $link['_id'] }}')">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                @if($totalPages > 1)
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            <li class="page-item {{ $pageNumber === 1 ? 'disabled' : '' }}">
                                <a wire:click="previous" class="page-link" href="#" tabindex="-1"><i
                                        class="fas fa-chevron-left"></i></a>
                            </li>
                            @for($no = $firstPage; $no <= $totalPages; $no++)
                                <li class="page-item {{ $no === $pageNumber ? 'active' : '' }}"
                                    wire:click="changePage({{ $no }})">
                                    <a class="page-link" href="#">{{ $no }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ $pageNumber === $totalPages ? 'disabled' : '' }}">
                                <a wire:click="next" class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>
</div>
