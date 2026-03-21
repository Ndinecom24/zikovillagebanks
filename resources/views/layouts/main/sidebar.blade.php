<aside class="main-sidebar zesco-sidebar elevation-4">

    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link zesco-brand-link">
        <img src="{{ asset('dashboard/dist/img/zesco1.png') }}" alt="Zesco Logo"
             class="brand-image img-rounded"
             style="opacity: .9">
        <span class="brand-text">REMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="zesco-sidebar-user">
            <div class="d-flex align-items-center">
                <div class="zesco-sidebar-avatar">
{{--                    <img src="{{ asset('storage/user_avatar/' . Auth::user()->avatar) }}"--}}
{{--                         alt="User"--}}
{{--                         onerror="this.src='{{ asset('dashboard/dist/img/avatar.png') }}';">--}}
                </div>
                <div class="ml-2" style="overflow: hidden;">
                    <div class="zesco-sidebar-username">{{ Auth::user()->name }}</div>
                    <div class="zesco-sidebar-role"><i class="fas fa-circle" style="font-size: 6px; vertical-align: middle; color: #34d399;"></i> Online</div>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column nav-flat" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- MAIN --}}
                <li class="nav-header zesco-nav-header">
                    <span>MAIN</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') || request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('clients.index') }}" class="nav-link {{ request()->routeIs('clients.*') || request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Clients</p>
                    </a>
                </li>


                {{-- LOCATION & SUBSTATIONS --}}
                <li class="nav-header zesco-nav-header">
                    <span>LOCATIONS & SUBSTATIONS</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('province.index') }}" class="nav-link {{ request()->routeIs('province.*') ? 'active' : '' }}">
                        <i class="fas fa-map-marked-alt nav-icon"></i>
                        <p>Provinces</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('district.index') }}" class="nav-link {{ request()->routeIs('district.*') ? 'active' : '' }}">
                        <i class="fas fa-city nav-icon"></i>
                        <p>Districts</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('connection-point.index') }}" class="nav-link {{ request()->routeIs('connection-point.*') ? 'active' : '' }}">
                        <i class="fas fa-bolt nav-icon"></i>
                        <p>Connection Points</p>
                    </a>
                </li>

                {{-- REPORTS --}}
                <li class="nav-header zesco-nav-header">
                    <span>REPORTS & FILES</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar nav-icon"></i>
                        <p>Reports & Analytics</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('files.index') }}" class="nav-link {{ request()->routeIs('files.*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open nav-icon"></i>
                        <p>File Manager</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('documents.index') }}" class="nav-link {{ request()->routeIs('documents.*') ? 'active' : '' }}">
                        <i class="fas fa-archive nav-icon"></i>
                        <p>Document Manager</p>
                    </a>
                </li>

                {{-- TASK MANAGEMENT --}}
                <li class="nav-header zesco-nav-header">
                    <span>TASK MANAGEMENT</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('task-manager.index') }}" class="nav-link {{ request()->routeIs('task-manager.*') ? 'active' : '' }}">
                        <i class="fas fa-project-diagram nav-icon"></i>
                        <p>Processes & Tasks</p>
                    </a>
                </li>

                {{-- CONFIGURATIONS --}}
                <li class="nav-header zesco-nav-header">
                    <span>CONFIGURATIONS</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('status.index') }}" class="nav-link {{ request()->routeIs('status.*') ? 'active' : '' }}">
                        <i class="fas fa-toggle-on nav-icon"></i>
                        <p>Statuses</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('venture.index') }}" class="nav-link {{ request()->routeIs('venture.*') ? 'active' : '' }}">
                        <i class="fas fa-handshake nav-icon"></i>
                        <p>Ventures</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('technology.index') }}" class="nav-link {{ request()->routeIs('technology.*') ? 'active' : '' }}">
                        <i class="fas fa-solar-panel nav-icon"></i>
                        <p>Technologies</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('module.index') }}" class="nav-link {{ request()->routeIs('module.*') ? 'active' : '' }}">
                        <i class="fas fa-puzzle-piece nav-icon"></i>
                        <p>Modules</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('office.index') }}" class="nav-link {{ request()->routeIs('office.*') ? 'active' : '' }}">
                        <i class="fas fa-building nav-icon"></i>
                        <p>Offices</p>
                    </a>
                </li>

                {{-- USERS --}}
                <li class="nav-header zesco-nav-header">
                    <span>USERS</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>

                {{-- ACCESS CONTROL --}}
                <li class="nav-header zesco-nav-header">
                    <span>ACCESS CONTROL</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                        <i class="fas fa-user-shield nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}" class="nav-link {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                        <i class="fas fa-key nav-icon"></i>
                        <p>Permissions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user-roles.index') }}" class="nav-link {{ request()->routeIs('user-roles.*') ? 'active' : '' }}">
                        <i class="fas fa-users-cog nav-icon"></i>
                        <p>User Roles</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>

