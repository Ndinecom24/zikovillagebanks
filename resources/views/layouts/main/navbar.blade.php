<nav class="main-header navbar navbar-expand zesco-navbar">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link zesco-nav-toggle" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link zesco-nav-breadcrumb">
                <i class="fas fa-bolt mr-1" style="color: #FFB223;"></i> Dashboard
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        {{-- Quick actions --}}
        <li class="nav-item">
            <a href="{{ route('independent-producer.index') }}" class="nav-link" title="New IPP" style="color: #6b7280;">
                <i class="fas fa-plus-circle"></i>
            </a>
        </li>

        {{-- User dropdown --}}
        <li class="nav-item dropdown zesco-user-dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown" href="#" style="gap: 0.5rem;">
                <div class="zesco-navbar-avatar">
                    <img src="{{ asset('storage/user_avatar/' . Auth::user()->avatar) }}"
                         alt="User"
                         onerror="this.src='{{ asset('dashboard/dist/img/avatar.png') }}';">
                    <span class="zesco-avatar-status"></span>
                </div>
                <div class="d-none d-md-block text-left" style="line-height: 1.2;">
                    <span class="zesco-navbar-username">{{ Auth::user()->name }}</span>
                    <small class="d-block zesco-navbar-role">Staff</small>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right zesco-user-menu">
                <div class="zesco-user-menu-header">
                    <div class="d-flex align-items-center">
                        <div class="zesco-menu-avatar">
                            <img src="{{ asset('storage/user_avatar/' . Auth::user()->avatar) }}"
                                 alt="User"
                                 onerror="this.src='{{ asset('dashboard/dist/img/avatar.png') }}';">
                        </div>
                        <div class="ml-2">
                            <strong>{{ Auth::user()->name }}</strong>
                            <small class="d-block" style="opacity: 0.85;">{{ Auth::user()->email ?? 'Staff Member' }}</small>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider" style="margin: 0;"></div>
                <a href="#" class="dropdown-item zesco-menu-item">
                    <i class="fas fa-user-circle mr-2" style="color: #14984f;"></i> My Profile
                </a>
                <a href="#" class="dropdown-item zesco-menu-item" onclick="event.preventDefault(); $('#modal-change-password').modal('show');">
                    <i class="fas fa-lock mr-2" style="color: #FFB223;"></i> Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item zesco-menu-item zesco-menu-logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
