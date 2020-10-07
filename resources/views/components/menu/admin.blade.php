<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="nav-item {{ request()->is('dashboard/admin') ? 'active' : '' }}">
        <a href="{{ route('dashboard.admin.overview') }}" class="nav-link"><i class="fas fa-fire"></i><span>Overview</span></a>
    </li>
    <li class="menu-header">Academic Management</li>
    <li class="nav-item">
        <a href="{{ route('dashboard.admin.assistant.index') }}" class="nav-link {{ request()->is('dashboard/admin/assistant') ? 'active' : '' }}"><i class="fas fa-group fa-user-shield"></i><span>Assistant</span></a>
        <a href="{{ route('dashboard.admin.classroom.index') }}" class="nav-link {{ request()->is('dashboard/admin/classroom') ? 'active' : '' }}"><i class="fas fa-group fa-users"></i><span>Class</span></a>
        <a href="{{ route('dashboard.admin.student.index')  }}" class="nav-link"><i class="fas fa-group fa-user"></i><span>Student</span></a>
        <a href="{{ route('dashboard.admin.assignment.index') }}" class="nav-link"><i class="fas fa-group fa-tasks"></i><span>Assignment</span></a>
        <a href="#" class="nav-link"><i class="fas fa-group fa-book"></i><span>Topic</span></a>
    </li>
    <li class="menu-header">Utility</li>
    <li class="nav-item">
        <a href="{{ route('dashboard.admin.link.index') }}" class="nav-link"><i class="fas fa-link"></i><span>Shortlink</span></a>
        <a href="#" class="nav-link"><i class="fas fa-calendar-check"></i><span>Calendar</span></a>
        <a href="#" class="nav-link"><i class="fas fa-bookmark"></i><span>Ticket</span></a>
        <a href="{{ route('dashboard.admin.setting.index') }}" class="nav-link"><i class="fas fa-setting fa-cogs"></i><span>Settings</span></a>
    </li>
</ul>