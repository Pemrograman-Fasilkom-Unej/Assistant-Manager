@extends('dashboard.admin.layouts.app')

@section('title', 'Pengaturan')

@section('css')

@endsection

@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">Link</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a>
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
                            <h5>Pengaturan</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.config.change-year') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="name">Tahun</label>
                                    <input type="number" class="form-control" aria-describedby="Tahun" placeholder="Tahun" name="year" required value="{{ $configs->where('key', 'year')->first()->value }}">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="name">Semester</label>
                                    <input type="number" class="form-control" aria-describedby="Semester" placeholder="Semester" name="semester" required value="{{ $configs->where('key', 'semester')->first()->value }}">
                                </div>
                            </div>
                            <div class="row col-2 justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')

@endsection

@section('js')
    <script>
    </script>
@endsection
