<aside class="main-sidebar nd-sidebar elevation-4">

    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link nd-brand-link">
        <img src="{{ asset('img/ndinecom_logo.png') }}" alt="Logo"
             class="brand-image img-rounded"
             style="opacity: .9"
             onerror="this.onerror=null; this.style.display='none';">
        <span class="brand-text"><span style="font-weight: 400;">Village</span> Bank</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel -->
        <div class="nd-sidebar-user">
            <div class="d-flex align-items-center">
                <div class="nd-sidebar-avatar">
                    <img src="{{ Auth::user()->avatar ? asset('storage/user_avatar/' . Auth::user()->avatar) : asset('img/default-avatar.svg') }}"
                         alt="User"
                         onerror="this.onerror=null; this.src='{{ asset('img/default-avatar.svg') }}';">
                </div>
                <div class="ml-2" style="overflow: hidden; flex: 1;">
                    <div class="nd-sidebar-username">{{ Auth::user()->name }}</div>
                    <div class="nd-sidebar-role">
                        <span class="nd-status-dot"></span> Online
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column nav-flat"
                data-widget="treeview" role="menu" data-accordion="true">

                {{-- ──────────────── MAIN ──────────────── --}}
                <li class="nav-header nd-nav-header">
                    <span>MAIN</span>
                </li>
                @can('view-dashboard')
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                       class="nav-link {{ request()->routeIs('home') || request()->is('/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endcan
                @can('discover-banks')
                <li class="nav-item">
                    <a href="{{ route('discover') }}"
                       class="nav-link {{ request()->routeIs('discover') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-search-location"></i>
                        <p>Discover Banks</p>
                    </a>
                </li>
                @endcan

                {{-- ──────────────── VILLAGE BANKING ──────────────── --}}
                @canany(['view-members', 'view-circles'])
                <li class="nav-header nd-nav-header">
                    <span>VILLAGE BANKING</span>
                </li>
                @endcanany

                {{-- Members --}}
                @can('view-members')
                <li class="nav-item has-treeview {{ request()->routeIs('members.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Members
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('members.index') }}"
                               class="nav-link {{ request()->routeIs('members.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Members</p>
                            </a>
                        </li>
                        @can('create-members')
                        <li class="nav-item">
                            <a href="{{ route('members.create') }}"
                               class="nav-link {{ request()->routeIs('members.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Member</p>
                            </a>
                        </li>
                        @endcan
                        @can('approve-members')
                        <li class="nav-item">
                            <a href="{{ route('members.approval') }}"
                               class="nav-link {{ request()->routeIs('members.approval') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Approvals</p>
                            </a>
                        </li>
                        @endcan
                        @can('manage-join-requests')
                        <li class="nav-item">
                            <a href="{{ route('members.join-requests') }}"
                               class="nav-link {{ request()->routeIs('members.join-requests') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Join Requests</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                {{-- Circles --}}
                @can('view-circles')
                <li class="nav-item has-treeview {{ request()->routeIs('circles.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('circles.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-circle-notch"></i>
                        <p>
                            Circles
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('circles.index') }}"
                               class="nav-link {{ request()->routeIs('circles.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Circles</p>
                            </a>
                        </li>
                        @can('create-circles')
                        <li class="nav-item">
                            <a href="{{ route('circles.create') }}"
                               class="nav-link {{ request()->routeIs('circles.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Circle</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                {{-- ──────────────── FINANCIAL ──────────────── --}}
                @canany(['view-shares', 'declare-shares', 'view-loans', 'request-loans', 'upload-payments', 'view-repayments', 'view-shareout'])
                <li class="nav-header nd-nav-header">
                    <span>FINANCIAL</span>
                </li>
                @endcanany

                {{-- Shares --}}
                @canany(['view-shares', 'declare-shares'])
                <li class="nav-item">
                    <a href="{{ route('shares.declare') }}"
                       class="nav-link {{ request()->routeIs('shares.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>Shares &amp; Insurance</p>
                    </a>
                </li>
                @endcanany

                {{-- Loans --}}
                @can('view-loans')
                <li class="nav-item has-treeview {{ request()->routeIs('loans.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('loans.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>
                            Loans
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('loans.index') }}"
                               class="nav-link {{ request()->routeIs('loans.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Loans</p>
                            </a>
                        </li>
                        @can('request-loans')
                        <li class="nav-item">
                            <a href="{{ route('loans.request') }}"
                               class="nav-link {{ request()->routeIs('loans.request') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Request Loan</p>
                            </a>
                        </li>
                        @endcan
                        @can('approve-loans')
                        <li class="nav-item">
                            <a href="{{ route('loans.approval') }}"
                               class="nav-link {{ request()->routeIs('loans.approval') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Approvals</p>
                            </a>
                        </li>
                        @endcan
                        @can('pair-loans')
                        <li class="nav-item">
                            <a href="{{ route('loans.pairing') }}"
                               class="nav-link {{ request()->routeIs('loans.pairing') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pairing</p>
                            </a>
                        </li>
                        @endcan
                        @can('force-loans')
                        <li class="nav-item">
                            <a href="{{ route('loans.forced') }}"
                               class="nav-link {{ request()->routeIs('loans.forced') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Forced Loan</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                {{-- Payments --}}
                @canany(['upload-payments', 'confirm-payments'])
                <li class="nav-item has-treeview {{ request()->routeIs('payments.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Payments
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('upload-payments')
                        <li class="nav-item">
                            <a href="{{ route('payments.upload') }}"
                               class="nav-link {{ request()->routeIs('payments.upload') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload Proof</p>
                            </a>
                        </li>
                        @endcan
                        @can('confirm-payments')
                        <li class="nav-item">
                            <a href="{{ route('payments.confirm') }}"
                               class="nav-link {{ request()->routeIs('payments.confirm') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Confirmations</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                {{-- Repayments --}}
                @canany(['view-repayments', 'make-repayments'])
                <li class="nav-item">
                    <a href="{{ route('repayments.index') }}"
                       class="nav-link {{ request()->routeIs('repayments.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>Repayments</p>
                    </a>
                </li>
                @endcanany

                {{-- Shareout --}}
                @canany(['view-shareout', 'calculate-shareout'])
                <li class="nav-item">
                    <a href="{{ route('shareout.index') }}"
                       class="nav-link {{ request()->routeIs('shareout.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Shareout</p>
                    </a>
                </li>
                @endcanany

                {{-- ──────────────── GOVERNANCE ──────────────── --}}
                @canany(['view-rules', 'manage-rules', 'view-polls', 'manage-polls', 'vote-polls', 'view-reports'])
                <li class="nav-header nd-nav-header">
                    <span>GOVERNANCE</span>
                </li>
                @endcanany

                {{-- Rules & Bylaws --}}
                @canany(['view-rules', 'manage-rules'])
                <li class="nav-item">
                    <a href="{{ route('rules.manage') }}"
                       class="nav-link {{ request()->routeIs('rules.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gavel"></i>
                        <p>Rules &amp; Bylaws</p>
                    </a>
                </li>
                @endcanany

                {{-- Polls --}}
                @canany(['view-polls', 'manage-polls', 'vote-polls'])
                <li class="nav-item has-treeview {{ request()->routeIs('polls.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('polls.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-poll"></i>
                        <p>
                            Polls &amp; Voting
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('manage-polls')
                        <li class="nav-item">
                            <a href="{{ route('polls.index') }}"
                               class="nav-link {{ request()->routeIs('polls.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Polls</p>
                            </a>
                        </li>
                        @endcan
                        @can('vote-polls')
                        <li class="nav-item">
                            <a href="{{ route('polls.vote') }}"
                               class="nav-link {{ request()->routeIs('polls.vote') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vote</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                {{-- Reports --}}
                @can('view-reports')
                <li class="nav-item">
                    <a href="{{ route('reports.index') }}"
                       class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Reports</p>
                    </a>
                </li>
                @endcan

                {{-- ──────────────── SETTINGS ──────────────── --}}
                @can('manage-bank-config')
                <li class="nav-header nd-nav-header">
                    <span>SETTINGS</span>
                </li>

                {{-- Bank Configuration --}}
                <li class="nav-item">
                    <a href="{{ route('settings.bank-config') }}"
                       class="nav-link {{ request()->routeIs('settings.bank-config') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Bank Configuration</p>
                    </a>
                </li>
                @endcan

                {{-- ──────────────── ADMINISTRATION ──────────────── --}}
                @canany(['manage-village-banks', 'manage-subscriptions', 'manage-training'])
                <li class="nav-header nd-nav-header">
                    <span>ADMINISTRATION</span>
                </li>
                @endcanany

                {{-- Village Banks (Super Admin) --}}
                @can('manage-village-banks')
                <li class="nav-item has-treeview {{ request()->routeIs('village-banks.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('village-banks.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            Village Banks
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('village-banks.index') }}"
                               class="nav-link {{ request()->routeIs('village-banks.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Banks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('village-banks.create') }}"
                               class="nav-link {{ request()->routeIs('village-banks.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Bank</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                {{-- Subscriptions --}}
                @canany(['manage-subscriptions', 'manage-licenses', 'review-applications', 'view-applications'])
                <li class="nav-item has-treeview {{ request()->routeIs('subscription.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('subscription.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Subscriptions
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('manage-subscriptions')
                        <li class="nav-item">
                            <a href="{{ route('subscription.plans') }}"
                               class="nav-link {{ request()->routeIs('subscription.plans') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Plans</p>
                            </a>
                        </li>
                        @endcan
                        @canany(['review-applications', 'view-applications'])
                        <li class="nav-item">
                            <a href="{{ route('subscription.applications') }}"
                               class="nav-link {{ request()->routeIs('subscription.applications') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Applications</p>
                            </a>
                        </li>
                        @endcanany
                        @can('manage-subscriptions')
                        <li class="nav-item">
                            <a href="{{ route('subscription.payments') }}"
                               class="nav-link {{ request()->routeIs('subscription.payments') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payments</p>
                            </a>
                        </li>
                        @endcan
                        @can('manage-licenses')
                        <li class="nav-item">
                            <a href="{{ route('subscription.licenses') }}"
                               class="nav-link {{ request()->routeIs('subscription.licenses') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Licenses</p>
                            </a>
                        </li>
                        @endcan
                        @can('manage-subscriptions')
                        <li class="nav-item">
                            <a href="{{ route('subscription.payment-config') }}"
                               class="nav-link {{ request()->routeIs('subscription.payment-config') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payment Config</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                {{-- Training --}}
                @can('manage-training')
                <li class="nav-item has-treeview {{ request()->routeIs('training.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('training.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>
                            Training
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('training.programs') }}"
                               class="nav-link {{ request()->routeIs('training.programs') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Programs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('training.applications') }}"
                               class="nav-link {{ request()->routeIs('training.applications') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Applications</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                {{-- ──────────────── USER & ACCESS ──────────────── --}}
                @canany(['view-users', 'manage-roles', 'view-activity-logs'])
                <li class="nav-header nd-nav-header">
                    <span>USER &amp; ACCESS</span>
                </li>
                @endcanany
                @can('view-users')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                       class="nav-link {{ request()->routeIs('users.*') && !request()->routeIs('user-roles.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Users</p>
                    </a>
                </li>
                @endcan
                @can('manage-roles')
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
                @endcan

                {{-- Activity Logs --}}
                @can('view-activity-logs')
                <li class="nav-item">
                    <a href="{{ route('activity-logs.index') }}"
                       class="nav-link {{ request()->routeIs('activity-logs.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Activity Logs</p>
                    </a>
                </li>
                @endcan

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>

