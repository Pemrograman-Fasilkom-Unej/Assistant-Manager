@extends('dashboard.assistant.layouts.app')

@section('title', 'Tugas')

@section('css')
    @include('components.style-datatables')
@endsection

@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">Link</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('assistant.dashboard') }}"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Links</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center m-l-0">
                        <div class="col-sm-6">
                            <h5>Daftar Link</h5>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="btn btn-success btn-sm has-ripple" data-toggle="modal"
                                data-target="#add-link-modal">
                                <span>
                                    <i class="feather icon-plus"></i>
                                </span>Tambah Link
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="link-table" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>ShortURL</th>
                                    <th>LongURL</th>
                                    <th>Tanggal</th>
                                    {{--<th>Action</th>--}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($links as $index => $link)
                                    <tr>
                                        <td>{{ $response->itemsPerPage * ($response->pageNumber-1) + $index + 1 }}</td>
                                        <td>
                                            <a href=" {{ env('SHORTLINK_URL') . $link->short_url }}" target="_blank">
                                                {{ env('SHORTLINK_URL') . $link->short_url }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ $link->long_url }}" target="_blank">
                                                {{ $link->long_url }}
                                            </a>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($link->created_at)->format('d M Y, H:i') }}</td>
                                        {{-- <td>
                                            <button type="button" class="btn btn-danger"
                                                onclick="deleteLink('{{ $link->_id }}')">
                                                Delete
                                            </button>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $links->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<form action="{{ route('assistant.link.delete') }}" method="post" id="delete-form">
        --}}
        {{--@csrf--}}
        {{--@method('DELETE')--}}
        {{--<input type="hidden" id="link-delete-id"
            name="id">--}}
        {{--</form>--}}
@endsection

@section('modals')
    <div id="add-link-modal" class="modal fade" role="dialog" aria-labelledby="share-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Pendekan Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('assistant.link.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="long-url">Masukan URL</label>
                            <input type="text" class="form-control" value="{{ old('long_url') }}" id="long-url"
                                name="long_url" placeholder="Long URL">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">{{ env('SHORTLINK_URL') }}</span>
                            </div>
                            <input type="text" class="form-control" value="{{ old('short_url') }}" id="short-url"
                                name="short_url" placeholder="Custom URL (Kosongi Random)">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('components.script-datatables')
    <script>

        // function deleteLink(id) {
        //     $('#link-delete-id').val(id);
        //     $('#delete-form').submit();
        // }

    </script>
@endsection
