<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="#!" class="b-brand mt-2 mb-2">
            <!-- ========   change your logo hear   ============ -->
            <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="" class="logo-thumb">
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
{{--            <li>--}}
{{--                <div class="dropdown">--}}
{{--                    <a class="dropdown-toggle" href="index.html#" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right notification">--}}
{{--                        <div class="noti-head">--}}
{{--                            <h6 class="d-inline-block m-b-0">Notifications</h6>--}}
{{--                            <div class="float-right">--}}
{{--                                <a href="index.html#!" class="m-r-10">mark as read</a>--}}
{{--                                <a href="index.html#!">clear all</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <ul class="noti-body">--}}
{{--                            <li class="n-title">--}}
{{--                                <p class="m-b-0">NEW</p>--}}
{{--                            </li>--}}
{{--                            <li class="notification">--}}
{{--                                <div class="media">--}}
{{--                                    <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>--}}
{{--                                        <p>New ticket Added</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="n-title">--}}
{{--                                <p class="m-b-0">EARLIER</p>--}}
{{--                            </li>--}}
{{--                            <li class="notification">--}}
{{--                                <div class="media">--}}
{{--                                    <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>--}}
{{--                                        <p>Prchace New Theme and make payment</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="notification">--}}
{{--                                <div class="media">--}}
{{--                                    <img class="img-radius" src="assets/images/user/avatar-1.jpg" alt="Generic placeholder image">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>--}}
{{--                                        <p>currently login</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="notification">--}}
{{--                                <div class="media">--}}
{{--                                    <img class="img-radius" src="assets/images/user/avatar-2.jpg" alt="Generic placeholder image">--}}
{{--                                    <div class="media-body">--}}
{{--                                        <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>--}}
{{--                                        <p>Prchace New Theme and make payment</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <div class="noti-footer">--}}
{{--                            <a href="index.html#!">show all</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
            <li>
                <div class="dropdown drp-user">
                    <a href="{{ url('/') }}" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="{{ Auth::user()->avatar_url }}" class="img-radius" alt="{{ auth()->user()->name }}">
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <ul class="pro-body">
                            <li><a class="dropdown-item" href="{{ route('assistant.profile.index') }}"><i class="feather icon-user"></i>Profile</a></li>
                            <li><a href="#" class="dropdown-item" onclick="$('#logout-form').submit()"><i class="feather icon-log-out"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <form action="{{ route('logout') }}" method="post" id="logout-form">
        @csrf
    </form>
</header>

{{--<header class="topbar">--}}
{{--    <nav class="navbar top-navbar navbar-expand-md navbar-dark">--}}
{{--        <div class="navbar-header">--}}
{{--            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>--}}
{{--            <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                <!-- Logo icon -->--}}
{{--                <b class="logo-icon">--}}
{{--                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->--}}
{{--                    <!-- Dark Logo icon -->--}}
{{--                    <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />--}}
{{--                    <!-- Light Logo icon -->--}}
{{--                    <img src="{{ asset('assets/images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />--}}
{{--                </b>--}}
{{--                <!--End Logo icon -->--}}
{{--                <!-- Logo text -->--}}
{{--                <span class="logo-text">--}}
{{--                    <!-- dark Logo text -->--}}
{{--                    <img src="{{ asset('assets/images/logo-text.png') }}" alt="homepage" class="dark-logo" />--}}
{{--                    <!-- Light Logo text -->--}}
{{--                    <img src="{{ asset('assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" />--}}
{{--                </span>--}}
{{--            </a>--}}
{{--            <!-- ============================================================== -->--}}
{{--            <!-- End Logo -->--}}
{{--            <!-- ============================================================== -->--}}
{{--            <!-- ============================================================== -->--}}
{{--            <!-- Toggle which is visible on mobile only -->--}}
{{--            <!-- ============================================================== -->--}}
{{--            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>--}}
{{--        </div>--}}
{{--        <!-- ============================================================== -->--}}
{{--        <!-- End Logo -->--}}
{{--        <!-- ============================================================== -->--}}
{{--        <div class="navbar-collapse collapse" id="navbarSupportedContent">--}}
{{--            <!-- ============================================================== -->--}}
{{--            <!-- toggle and nav items -->--}}
{{--            <!-- ============================================================== -->--}}
{{--            <ul class="navbar-nav float-left mr-auto">--}}
{{--                <li class="nav-item d-none d-md-block">--}}
{{--                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">--}}
{{--                        <i class="mdi mdi-menu font-24"></i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                --}}{{--<!-- ============================================================== -->--}}
{{--                --}}{{--<!-- create new -->--}}
{{--                --}}{{--<!-- ============================================================== -->--}}
{{--                --}}{{--<li class="nav-item dropdown">--}}
{{--                    --}}{{--<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        --}}{{--<span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>--}}
{{--                        --}}{{--<span class="d-block d-md-none"><i class="fa fa-plus"></i></span>--}}
{{--                    --}}{{--</a>--}}
{{--                    --}}{{--<div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                        --}}{{--<a class="dropdown-item" href="#">Action</a>--}}
{{--                        --}}{{--<a class="dropdown-item" href="#">Another action</a>--}}
{{--                        --}}{{--<div class="dropdown-divider"></div>--}}
{{--                        --}}{{--<a class="dropdown-item" href="#">Something else here</a>--}}
{{--                    --}}{{--</div>--}}
{{--                --}}{{--</li>--}}
{{--            </ul>--}}
{{--            <ul class="navbar-nav float-right">--}}
{{--                --}}{{-- TODO : Notifications --}}
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>--}}

{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">--}}
{{--                        <span class="with-arrow"><span class="bg-primary"></span></span>--}}
{{--                        <ul class="list-style-none">--}}
{{--                            <li>--}}
{{--                                <div class="drop-title bg-primary text-white">--}}
{{--                                    <h4 class="mb-0 mt-1">4 New</h4>--}}
{{--                                    <span class="font-light">Notifications</span>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="message-center notifications">--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="javascript:void(0)" class="message-item">--}}
{{--                                        <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>--}}
{{--                                        <div class="mail-contnet">--}}
{{--                                            <h5 class="message-title">Luanch Admin</h5> <span class="mail-desc">Just see the my new assistant!</span> <span class="time">9:30 AM</span> </div>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="javascript:void(0)" class="message-item">--}}
{{--                                        <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>--}}
{{--                                        <div class="mail-contnet">--}}
{{--                                            <h5 class="message-title">Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="javascript:void(0)" class="message-item">--}}
{{--                                        <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>--}}
{{--                                        <div class="mail-contnet">--}}
{{--                                            <h5 class="message-title">Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="javascript:void(0)" class="message-item">--}}
{{--                                        <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>--}}
{{--                                        <div class="mail-contnet">--}}
{{--                                            <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my assistant!</span> <span class="time">9:02 AM</span> </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a class="nav-link text-center mb-1 text-dark" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" class="rounded-circle" width="31"></a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">--}}
{{--                        <span class="with-arrow"><span class="bg-primary"></span></span>--}}
{{--                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white mb-2">--}}
{{--                            <div class=""><img src="{{ asset('assets/images/users/1.jpg') }}" alt="user" class="img-circle" width="60"></div>--}}
{{--                            <div class="ml-2">--}}
{{--                                <h4 class="mb-0">Steave Jobs</h4>--}}
{{--                                <p class=" mb-0">varun@gmail.com</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings mr-1 ml-1"></i> Account Setting</a>--}}
{{--                        <div class="dropdown-divider"></div>--}}
{{--                        <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--</header>--}}