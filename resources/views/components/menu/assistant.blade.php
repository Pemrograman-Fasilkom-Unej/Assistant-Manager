<ul class="sidebar-menu">
    <li class="menu-header">Assistant Dashboard</li>
    <li class="nav-item">
        <a href="{{ route('dashboard.assistant.overview') }}" class="nav-link"><i class="fas fa-fire"></i><span>Overview</span></a>
    </li>
    <li class="menu-header">Academic Management</li>
    <li class="nav-item">
        <a href="{{ route('dashboard.assistant.classroom.index') }}" class="nav-link {{ request()->is('dashboard/assistant/classroom*') ? 'active' : '' }}"><i class="fas fa-group fa-users"></i><span>Classroom</span></a>
        <a href="{{ route('dashboard.assistant.student.index')  }}" class="nav-link"><i class="fas fa-group fa-user"></i><span>Student</span></a>
        <a href="{{ route('dashboard.assistant.assignment.index') }}" class="nav-link"><i class="fas fa-group fa-tasks"></i><span>Assignment</span></a>
    </li>
    <li class="menu-header">Utility</li>
    <li class="nav-item">
        <a href="{{ route('dashboard.assistant.link.index') }}" class="nav-link"><i class="fas fa-link"></i><span>Shortlink</span></a>
        <a href="{{ route('dashboard.coming-soon') }}" class="nav-link"><i class="fas fa-calendar-check"></i><span>Calendar</span></a>
        <a href="{{ route('dashboard.coming-soon') }}" class="nav-link"><i class="fas fa-bookmark"></i><span>Ticket</span></a>
    </li>
</ul>
