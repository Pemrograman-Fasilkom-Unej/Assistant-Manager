@extends('dashboard.admin.layouts.app')

@section('title', 'Tugas')

@section('css')
    @include('components.style-datatables')
@endsection

@section('breadcrumb')
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Ticket</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Ticket</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tickets</h4>
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
                            <tr>
                                <td><span class="label label-warning">In Progress</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">Elegant Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">276377</a></td>
                                <td>Elegant Admin</td>
                                <td>Eric Pratt</td>
                                <td>2018/05/01</td>
                                <td>Fazz</td>
                            </tr>
                            <tr>
                                <td><span class="label label-danger">Closed</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">AdminX Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">1234251</a></td>
                                <td>AdminX Admin</td>
                                <td>Nirav Joshi</td>
                                <td>2018/05/11</td>
                                <td>Steve</td>
                            </tr>
                            <tr>
                                <td><span class="label label-success">Opened</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">Admin-Pro Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">1020345</a></td>
                                <td>Admin-Pro</td>
                                <td>Vishal Bhatt</td>
                                <td>2018/04/01</td>
                                <td>John</td>
                            </tr>
                            <tr>
                                <td><span class="label label-warning">In Progress</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">Elegant Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">7810203</a></td>
                                <td>Elegant Admin</td>
                                <td>Eric Pratt</td>
                                <td>2018/01/01</td>
                                <td>Fazz</td>
                            </tr>
                            <tr>
                                <td><span class="label label-warning">In Progress</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">AdminX Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">2103450</a></td>
                                <td>AdminX Admin</td>
                                <td>Nirav Joshi</td>
                                <td>2018/05/01</td>
                                <td>John</td>
                            </tr>
                            <tr>
                                <td><span class="label label-warning">In Progress</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">Admin-Pro Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">2140530</a></td>
                                <td>Admin-Pro</td>
                                <td>Vishal Bhatt</td>
                                <td>2018/07/01</td>
                                <td>Steve</td>
                            </tr>
                            <tr>
                                <td><span class="label label-success">Opened</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">Elegant Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">4500123</a></td>
                                <td>Elegant Admin</td>
                                <td>Eric Pratt</td>
                                <td>2018/05/10</td>
                                <td>Fazz</td>
                            </tr>
                            <tr>
                                <td><span class="label label-danger">Closed</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">Elegant Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">1230450</a></td>
                                <td>Elegant Admin</td>
                                <td>Eric Pratt</td>
                                <td>2018/05/14</td>
                                <td>John</td>
                            </tr>
                            <tr>
                                <td><span class="label label-danger">Closed</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">AdminX Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">1240503</a></td>
                                <td>AdminX Admin</td>
                                <td>Nirav Joshi</td>
                                <td>2018/02/01</td>
                                <td>Steve</td>
                            </tr>
                            <tr>
                                <td><span class="label label-success">Opened</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">Admin-Pro Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">1250304</a></td>
                                <td>Admin-Pro</td>
                                <td>Vishal Bhatt</td>
                                <td>2018/05/21</td>
                                <td>Fazz</td>
                            </tr>
                            <tr>
                                <td><span class="label label-success">Opened</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">Elegant Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">1470250</a></td>
                                <td>Elegant Admin</td>
                                <td>Eric Pratt</td>
                                <td>2018/05/11</td>
                                <td>John</td>
                            </tr>
                            <tr>
                                <td><span class="label label-danger">Closed</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">Admin-Pro Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">1450023</a></td>
                                <td>Admin-Pro</td>
                                <td>Vishal Bhatt</td>
                                <td>2018/05/13</td>
                                <td>Steve</td>
                            </tr>
                            <tr>
                                <td><span class="label label-warning">In Progress</span></td>
                                <td><a href="ticket-detail.html" class="font-medium link">AdminX Theme Side Menu Open OnClick</a></td>
                                <td><a href="ticket-detail.html" class="font-bold link">1420530</a></td>
                                <td>AdminX Admin</td>
                                <td>Nirav Joshi</td>
                                <td>2018/10/01</td>
                                <td>Fazz</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Status</th>
                                <th>Title</th>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Created by</th>
                                <th>Date</th>
                                <th>Agent</th>
                            </tr>
                            </tfoot>
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
        $('#task-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: '{{ route('ajax.admin.task.index') }}',
            columns: [
                { data: 'no' },
                { data: '_class' },
                { data: 'title' },
                { data: '_url' },
                { data: '_deadline' },
                { data: 'action' },
            ]
        })
    </script>
@endsection