<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">

            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ Auth::user()->avatar ?? asset('assets/images/user/default.png') }}"
                         alt="User-Profile-Image">
                    <div class="user-details">
                        <div id="more-details">{{ \Illuminate\Support\Facades\Auth::user()->name }}</div>
                    </div>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Main Menu</label>
                </li>
                <li class="nav-item"><a href="{{ route('assistant.dashboard') }}" class="nav-link "><span
                                class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span
                                class="pcoded-mtext">Dashboard</span></a></li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-users"></i>
                        </span>
                        <span class="pcoded-mtext">Kelas</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{ route('assistant.class.index') }}">Kelas</a></li>
                        @foreach(\App\Classes::get() as $class)
                            <li><a href="{{ route('assistant.class.show', $class) }}">{{ $class->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('assistant.task.index') }}" class="nav-link "><span
                                class="pcoded-micon"><i class="feather icon-paperclip"></i></span><span
                                class="pcoded-mtext">Tugas</span></a></li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Others</label>
                </li>
                {{--<li class="nav-item"><a href="{{ route('assistant.ticket.index') }}" class="nav-link "><span--}}
                                {{--class="pcoded-micon"><i class="feather icon-bookmark"></i></span><span--}}
                                {{--class="pcoded-mtext">Tickets</span></a></li>--}}
                {{--<li class="nav-item"><a href="{{ route('assistant.calendar.index') }}" class="nav-link "><span--}}
                                {{--class="pcoded-micon"><i class="feather icon-calendar"></i></span><span--}}
                                {{--class="pcoded-mtext">Kalender</span></a></li>--}}
                <li class="nav-item"><a href="{{ route('assistant.link.index') }}" class="nav-link "><span
                                class="pcoded-micon"><i class="feather icon-link"></i></span><span class="pcoded-mtext">Shortlink</span></a>
                {{--</li>--}}
                {{--<li class="nav-item"><a href="{{ route('assistant.note.index') }}" class="nav-link "><span--}}
                                {{--class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Notes</span></a>--}}
                {{--</li>--}}
                {{--<li class="nav-item"><a href="{{ route('assistant.note.index') }}" class="nav-link "><span--}}
                                {{--class="pcoded-micon"><i class="feather icon-settings"></i></span><span--}}
                                {{--class="pcoded-mtext">Pengaturan</span></a></li>--}}
            </ul>
        </div>
    </div>
</nav>