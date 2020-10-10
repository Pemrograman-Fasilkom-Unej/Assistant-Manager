<ul class="sidebar-menu">
    <li class="menu-header">Student Dashboard</li>
    <li class="nav-item">
        <a href="{{ route('dashboard.student.overview') }}" class="nav-link"><i class="fas fa-fire"></i><span>Overview</span></a>
    </li>
    <li class="menu-header">Academic</li>
    <li class="nav-item">
        <a href="{{ route('dashboard.student.classroom.index') }}" class="nav-link"><i class="fas fa-group fa-users"></i><span>Classroom</span></a>
        <a href="{{ route('dashboard.student.assignment.index') }}" class="nav-link"><i class="fas fa-group fa-tasks"></i><span>Assignment</span></a>
    </li>

    <li class="menu-header">Utility</li>
    <li class="nav-item">
        <a href="{{ route('dashboard.coming-soon') }}" class="nav-link"><i class="fas fa-calendar-check"></i><span>Calendar</span></a>
    </li>
</ul>
