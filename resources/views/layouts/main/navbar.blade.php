<nav class="main-header navbar navbar-expand nd-navbar">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link nd-nav-toggle" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link nd-nav-breadcrumb">
                <i class="fas fa-home mr-1" style="color: #D97706;"></i> Dashboard
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        {{-- Village Bank Indicator --}}
        @auth
            @if(Auth::user()->user_role_id != 1 || session('current_village_bank_id'))
            <li class="nav-item d-flex align-items-center mr-2">
                <a href="#" class="nav-link d-flex align-items-center" style="gap:0.4rem;background:rgba(30,58,95,0.08);border-radius:8px;padding:0.35rem 0.75rem;color:#1E3A5F;font-size:0.82rem;font-weight:600;" onclick="event.preventDefault(); Livewire.emit('openBankSelector');" title="Switch Village Bank">
                    <i class="fas fa-university" style="color:#D97706;font-size:0.9rem;"></i>
                    <span class="d-none d-md-inline">{{ session('current_village_bank_name', 'Select Bank') }}</span>
                    <i class="fas fa-exchange-alt ml-1" style="font-size:0.65rem;opacity:0.5;"></i>
                </a>
            </li>
            @endif
        @endauth

        {{-- Quick actions --}}
        <li class="nav-item">
            <a href="{{ route('members.create') }}" class="nav-link" title="Add Member" style="color: #6b7280;">
                <i class="fas fa-user-plus"></i>
            </a>
        </li>

        {{-- User dropdown --}}
        <li class="nav-item dropdown nd-user-dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown" href="#" style="gap: 0.5rem;">
                <div class="nd-navbar-avatar">
                    <img src="{{ Auth::user()->avatar ? asset('storage/user_avatar/' . Auth::user()->avatar) : asset('img/default-avatar.svg') }}"
                         alt="User"
                         onerror="this.onerror=null; this.src='{{ asset('img/default-avatar.svg') }}';">
                    <span class="nd-avatar-status"></span>
                </div>
                <div class="d-none d-md-block text-left" style="line-height: 1.2;">
                    <span class="nd-navbar-username">{{ Auth::user()->name }}</span>
                    <small class="d-block nd-navbar-role">Staff</small>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right nd-user-menu">
                <div class="nd-user-menu-header">
                    <div class="d-flex align-items-center">
                        <div class="nd-menu-avatar">
                            <img src="{{ Auth::user()->avatar ? asset('storage/user_avatar/' . Auth::user()->avatar) : asset('img/default-avatar.svg') }}"
                                 alt="User"
                                 onerror="this.onerror=null; this.src='{{ asset('img/default-avatar.svg') }}';">
                        </div>
                        <div class="ml-2">
                            <strong>{{ Auth::user()->name }}</strong>
                            <small class="d-block" style="opacity: 0.85;">{{ Auth::user()->email ?? 'Staff Member' }}</small>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider" style="margin: 0;"></div>
                <a href="{{ route('profile') }}" class="dropdown-item nd-menu-item">
                    <i class="fas fa-user-circle mr-2" style="color: #1E3A5F;"></i> My Profile
                </a>
                <a href="#" class="dropdown-item nd-menu-item" onclick="event.preventDefault(); $('#modal-change-password').modal('show');">
                    <i class="fas fa-lock mr-2" style="color: #D97706;"></i> Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item nd-menu-item nd-menu-logout"
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
