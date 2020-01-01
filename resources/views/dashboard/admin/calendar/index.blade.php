@extends('dashboard.admin.layouts.app')

@section('title', 'Kalender')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/calendar.css') }}">
@endsection

@section('breadcrumb')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">Kalender</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Kalender</a></li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <!-- [ Full-calendar ] start -->
        <div class="col-sm-12">
            <div class="card fullcalendar-card">
                <div class="card-header">
                    <h5>Full Calendar</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <div id='calendar' class='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Full-calendar ] end -->
    </div>
@endsection

@section('modals')
    <div class="modal fade none-border" id="my-event">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Add Event</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event
                    </button>
                    <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                            data-dismiss="modal">Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Category -->
    <div class="modal fade none-border" id="add-new-event">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Add</strong> a category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.calendar.store') }}" id="add-schedule-form">
                        @csrf
                        <input type="hidden" name="start" id="add-start-date">
                        <input type="hidden" name="end" id="add-end-date">
                        <input type="hidden" name="type" id="add-type">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Name</label>
                                <input class="form-control form-white" placeholder="Enter name" type="text" id="add-title"
                                       name="title"/>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Choose Category Color</label>
                                <select class="form-control form-white" data-placeholder="Choose a color..."
                                        name="category">
                                    <option value="success">Success</option>
                                    <option value="danger">Danger</option>
                                    <option value="info">Info</option>
                                    <option value="primary">Primary</option>
                                    <option value="warning">Warning</option>
                                    <option value="inverse">Inverse</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect waves-light save-category"
                            data-dismiss="modal">Save
                    </button>
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/js/plugins/moment.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
    <script>
        var add_url = '{{ route('admin.calendar.store') }}';
        var schedules = {!! json_encode($schedules) !!};
    </script>
    <script src="{{ asset('dist/js/calendar-init.js') }}"></script>
@endsection