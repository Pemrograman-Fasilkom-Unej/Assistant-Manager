@extends('dashboard.admin.layouts.app')

@section('title', 'Tugas')

@section('css')
    @include('components.style-datatables')
@endsection

@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">Kelas</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('admin.ticket.index') }}">Daftar Ticket</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tickets</h4>
                </div>
                <div class="card-body">
                    <div class="row mt-5">
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white">{{ \App\Ticket::count() }}</h1>
                                    <h6 class="text-white">Total Tickets</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="box bg-warning text-center">
                                    <h1 class="font-light text-white">{{ \App\Ticket::whereStatus(1)->count() }}</h1>
                                    <h6 class="text-white">In Progreess</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white">{{ \App\Ticket::whereStatus(2)->count() }}</h1>
                                    <h6 class="text-white">Solved</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card card-hover">
                                <div class="box bg-dark text-center">
                                    <h1 class="font-light text-white">{{ \App\Ticket::whereStatus(0)->count() }}</h1>
                                    <h6 class="text-white">Pending</h6>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                    <div class="table-responsive">
                        <table id="ticket-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>Title</th>
                                <th>Asisten</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--<tr>--}}
                                {{--<td><label class="badge badge-light-success">Solved</label></td>--}}
                                {{--<td><a href="ticket-detail.html" class="font-medium link">Elegant Theme Side Menu Open OnClick</a></td>--}}
                                {{--<td>Eric Pratt</td>--}}
                                {{--<td>2018/05/01</td>--}}
                                {{--<td>Fazz</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td><label class="badge badge-light-primary">Pending</label></td>--}}
                                {{--<td><a href="ticket-detail.html" class="font-medium link">AdminX Theme Side Menu Open OnClick</a></td>--}}
                                {{--<td>Nirav Joshi</td>--}}
                                {{--<td>2018/05/11</td>--}}
                                {{--<td>Steve</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td><label class="badge badge-light-danger">Canceled</label></td>--}}
                                {{--<td><a href="ticket-detail.html" class="font-medium link">Admin-Pro Theme Side Menu Open OnClick</a></td>--}}
                                {{--<td>Vishal Bhatt</td>--}}
                                {{--<td>2018/04/01</td>--}}
                                {{--<td>John</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td><label class="badge badge-light-warning">In Progress</label></td>--}}
                                {{--<td><a href="ticket-detail.html" class="font-medium link">Elegant Theme Side Menu Open OnClick</a></td>--}}
                                {{--<td>Eric Pratt</td>--}}
                                {{--<td>2018/01/01</td>--}}
                                {{--<td>Fazz</td>--}}
                            {{--</tr>--}}
                            </tbody>
                        </table>
                        <ul class="pagination float-right">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('components.script-datatables')
    <script>
        $('#ticket-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: '{{ route('ajax.admin.ticket.index') }}',
            columns: [
                { data: '_status' },
                { data: 'title' },
                { data: '_assistant' },
                { data: '_date' },
                { data: 'action' },
            ]
        })
    </script>
@endsection