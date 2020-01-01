<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >

            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ Auth::user()->avatar ?? asset('assets/images/user/avatar-2.jpg') }}" alt="User-Profile-Image">
                    <div class="user-details">
                        <div id="more-details">UX Designer <i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="user-profile.html" data-toggle="tooltip" title="View Profile"><i class="feather icon-user"></i></a></li>
                        <li class="list-inline-item"><a href="email_inbox.html"><i class="feather icon-mail" data-toggle="tooltip" title="Messages"></i><small class="badge badge-pill badge-primary">5</small></a></li>
                        <li class="list-inline-item"><a href="auth-signin.html" data-toggle="tooltip" title="Logout" class="text-danger"><i class="feather icon-power"></i></a></li>
                    </ul>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Main Menu</label>
                </li>
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-users"></i>
                        </span>
                        <span class="pcoded-mtext">Kelas</span>
                    </a>
                    <ul class="pcoded-submenu">
                            <li><a href="{{ route('admin.class.index') }}">Kelas</a></li>
                        @foreach(Auth::user()->classes as $class)
                            <li><a href="{{ route('admin.class.show', $class) }}">{{ $class->classes->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('admin.task.index') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-paperclip"></i></span><span class="pcoded-mtext">Tugas</span></a></li>
                <li class="nav-item"><a href="{{ route('admin.assistant.index') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Asisten Praktikum</span></a></li>

                <li class="nav-item pcoded-menu-caption">
                    <label>Others</label>
                </li>
                <li class="nav-item"><a href="{{ route('admin.ticket.index') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-bookmark"></i></span><span class="pcoded-mtext">Tickets</span></a></li>
                <li class="nav-item"><a href="{{ route('admin.calendar.index') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-calendar"></i></span><span class="pcoded-mtext">Kalender</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-link"></i></span><span class="pcoded-mtext">Shortlink</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Notes</span></a></li>
                <li class="nav-item"><a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">Pengaturan</span></a></li>
            </ul>
        </div>
    </div>
</nav>