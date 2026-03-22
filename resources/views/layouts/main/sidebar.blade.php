<aside class="main-sidebar zesco-sidebar elevation-4">

    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link zesco-brand-link">
        <img src="{{ asset('img/zesco_logo.png') }}" alt="Zesco Logo"
             class="brand-image img-rounded"
             style="opacity: .9"
             onerror="this.onerror=null; this.style.display='none';">
        <span class="brand-text"><span style="font-weight: 400;">Renewable</span> REMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel -->
        <div class="zesco-sidebar-user">
            <div class="d-flex align-items-center">
                <div class="zesco-sidebar-avatar">
                    <img src="{{ asset('storage/user_avatar/' . Auth::user()->avatar) }}"
                         alt="User"
                         onerror="this.onerror=null; this.src='{{ asset('img/default-avatar.svg') }}';">
                </div>
                <div class="ml-2" style="overflow: hidden; flex: 1;">
                    <div class="zesco-sidebar-username">{{ Auth::user()->name }}</div>
                    <div class="zesco-sidebar-role">
                        <span class="zesco-status-dot"></span> Online
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column nav-flat"
                data-widget="treeview" role="menu" data-accordion="true">

                {{-- ──────────────── MAIN ──────────────── --}}
                <li class="nav-header zesco-nav-header">
                    <span>MAIN</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                       class="nav-link {{ request()->routeIs('home') || request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- ──────────────── IPP MANAGEMENT ──────────────── --}}
                <li class="nav-header zesco-nav-header">
                    <span>IPP MANAGEMENT</span>
                </li>
                <li class="nav-item {{ request()->routeIs('independent-producer.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('independent-producer.index') }}"
                       class="nav-link {{ request()->routeIs('independent-producer.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-solar-panel"></i>
                        <p>Power Producers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('clients.index') }}"
                       class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Clients</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('client-tasks.index') }}"
                       class="nav-link {{ request()->routeIs('client-tasks.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Task Action Centre</p>
                    </a>
                </li>

                {{-- ──────────────── LOCATIONS & GRID ──────────────── --}}
                <li class="nav-header zesco-nav-header">
                    <span>LOCATIONS &amp; GRID</span>
                </li>
                <li class="nav-item has-treeview {{ request()->routeIs('province.*') || request()->routeIs('district.*') || request()->routeIs('connection-point.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('province.*') || request()->routeIs('district.*') || request()->routeIs('connection-point.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>
                            Locations
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right zesco-badge">3</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('province.index') }}"
                               class="nav-link {{ request()->routeIs('province.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Provinces</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('district.index') }}"
                               class="nav-link {{ request()->routeIs('district.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Districts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('connection-point.index') }}"
                               class="nav-link {{ request()->routeIs('connection-point.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Connection Points</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ──────────────── REPORTS & DATA ──────────────── --}}
                <li class="nav-header zesco-nav-header">
                    <span>REPORTS &amp; DATA</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.index') }}"
                       class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Reports &amp; Analytics</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->routeIs('files.*') || request()->routeIs('documents.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('files.*') || request()->routeIs('documents.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            File Storage
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('files.index') }}"
                               class="nav-link {{ request()->routeIs('files.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>File Manager</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('documents.index') }}"
                               class="nav-link {{ request()->routeIs('documents.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Documents</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ──────────────── TASK MANAGEMENT ──────────────── --}}
                <li class="nav-header zesco-nav-header">
                    <span>WORKFLOW</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('task-manager.index') }}"
                       class="nav-link {{ request()->routeIs('task-manager.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-project-diagram"></i>
                        <p>Processes &amp; Tasks</p>
                    </a>
                </li>

                {{-- ──────────────── CONFIGURATIONS ──────────────── --}}
                <li class="nav-header zesco-nav-header">
                    <span>CONFIGURATIONS</span>
                </li>
                <li class="nav-item has-treeview {{ request()->routeIs('status.*') || request()->routeIs('venture.*') || request()->routeIs('technology.*') || request()->routeIs('module.*') || request()->routeIs('office.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('status.*') || request()->routeIs('venture.*') || request()->routeIs('technology.*') || request()->routeIs('module.*') || request()->routeIs('office.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            System Setup
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-warning right zesco-badge">5</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('status.index') }}"
                               class="nav-link {{ request()->routeIs('status.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Statuses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('venture.index') }}"
                               class="nav-link {{ request()->routeIs('venture.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ventures</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('technology.index') }}"
                               class="nav-link {{ request()->routeIs('technology.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Technologies</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('module.index') }}"
                               class="nav-link {{ request()->routeIs('module.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Modules</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('office.index') }}"
                               class="nav-link {{ request()->routeIs('office.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Offices</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ──────────────── USER & ACCESS ──────────────── --}}
                <li class="nav-header zesco-nav-header">
                    <span>USER &amp; ACCESS</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}"
                       class="nav-link {{ request()->routeIs('user.*') && !request()->routeIs('user-roles.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->routeIs('roles.*') || request()->routeIs('permissions.*') || request()->routeIs('user-roles.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('roles.*') || request()->routeIs('permissions.*') || request()->routeIs('user-roles.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>
                            Access Control
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}"
                               class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}"
                               class="nav-link {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user-roles.index') }}"
                               class="nav-link {{ request()->routeIs('user-roles.*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Roles</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>

