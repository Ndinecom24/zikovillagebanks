<div>
    @push('custom-styles')
    <style>
        /* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
         *  USER PROFILE â€” Page-Specific Styles Only
         *  Common styles (hero, cards, buttons, modals,
         *  flash, forms, info-grid, empty, loading)
         *  are now in /css/ndinecom-admin.css (nd-* prefix).
         * â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */

        /* â”€â”€ Layout Grid â”€â”€ */
        .pf-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 1.5rem;
            margin-top: -4rem;
            position: relative; z-index: 10;
            padding: 0 1.5rem 2rem;
        }
        @media (max-width: 992px) {
            .pf-grid { grid-template-columns: 1fr; }
        }

        /* â”€â”€ Left Sidebar Card â”€â”€ */
        .pf-sidebar-top {
            background: linear-gradient(135deg, var(--nd-navy) 0%, var(--nd-navy-light) 100%);
            padding: 2rem 1.5rem 1.5rem;
            text-align: center;
            position: relative;
        }
        .pf-avatar-wrap {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }
        .pf-avatar {
            width: 110px; height: 110px;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.25);
            object-fit: cover;
            background: rgba(255,255,255,0.08);
        }
        .pf-avatar-badge {
            position: absolute; bottom: 4px; right: 4px;
            width: 34px; height: 34px;
            border-radius: 50%;
            background: var(--nd-amber);
            border: 3px solid var(--nd-navy);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            color: #fff; font-size: 0.75rem;
            transition: transform 0.2s, background 0.2s;
        }
        .pf-avatar-badge:hover { background: #b45309; transform: scale(1.12); }
        .pf-sidebar-name { color: #fff; font-size: 1.15rem; font-weight: 700; margin: 0; }
        .pf-sidebar-email { color: rgba(255,255,255,0.6); font-size: 0.82rem; margin: 0.2rem 0 0; }
        .pf-role-chip {
            display: inline-flex; align-items: center; gap: 0.3rem;
            background: rgba(255,255,255,0.12);
            color: var(--nd-amber-light);
            padding: 0.2rem 0.8rem;
            border-radius: 20px;
            font-size: 0.72rem; font-weight: 600;
            margin-top: 0.65rem;
            letter-spacing: 0.3px;
        }

        .pf-sidebar-stats {
            display: grid; grid-template-columns: repeat(3, 1fr);
            border-top: 1px solid var(--nd-border);
        }
        .pf-sidebar-stat {
            text-align: center; padding: 0.85rem 0.25rem;
            border-right: 1px solid var(--nd-border);
            transition: background 0.15s;
        }
        .pf-sidebar-stat:last-child { border-right: none; }
        .pf-sidebar-stat:hover { background: #fffbeb; }
        .pf-stat-num { font-size: 1.2rem; font-weight: 800; color: var(--nd-navy); }
        .pf-stat-lbl {
            font-size: 0.62rem; text-transform: uppercase; letter-spacing: 0.5px;
            color: var(--nd-faint); font-weight: 700; margin-top: 1px;
        }

        /* Sidebar nav */
        .pf-sidebar-nav { padding: 0.75rem 0; }
        .pf-sidebar-link {
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.6rem 1.5rem;
            font-size: 0.84rem; font-weight: 600;
            color: var(--nd-muted);
            cursor: pointer;
            transition: all 0.15s;
            border: none; background: none; width: 100%; text-align: left;
        }
        .pf-sidebar-link:hover { color: var(--nd-navy); background: #f8fafc; }
        .pf-sidebar-link.active {
            color: var(--nd-amber);
            background: #fffbeb;
            border-right: 3px solid var(--nd-amber);
        }
        .pf-sidebar-link i { width: 18px; text-align: center; font-size: 0.85rem; }

        /* Quick-links */
        .pf-quicklinks {
            padding: 0.75rem 1.25rem;
            border-top: 1px solid var(--nd-border);
        }
        .pf-quicklinks-title {
            font-size: 0.58rem; text-transform: uppercase; letter-spacing: 0.7px;
            font-weight: 800; color: var(--nd-faint); margin-bottom: 0.6rem;
            display: flex; align-items: center; gap: 0.35rem;
        }
        .pf-quicklinks-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 0.45rem;
        }
        .pf-quicklink {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.55rem 0.7rem;
            border-radius: 10px;
            border: 1px solid var(--nd-border);
            font-size: 0.76rem; font-weight: 600;
            color: var(--nd-muted);
            text-decoration: none;
            transition: all 0.15s;
        }
        .pf-quicklink:hover {
            border-color: var(--nd-amber); color: var(--nd-navy);
            background: #fffbeb; text-decoration: none;
            transform: translateY(-1px); box-shadow: 0 2px 8px rgba(217,119,6,0.08);
        }
        .pf-quicklink i {
            width: 22px; height: 22px; border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.6rem; flex-shrink: 0;
        }
        .pf-ql-dashboard i { background: #dbeafe; color: #1d4ed8; }
        .pf-ql-vb i { background: linear-gradient(135deg, var(--nd-navy), var(--nd-navy-light)); color: #fff; }
        .pf-ql-loans i { background: #fef3c7; color: #b45309; }
        .pf-ql-shares i { background: #d1fae5; color: #059669; }
        .pf-ql-repay i { background: #ede9fe; color: #7c3aed; }
        .pf-ql-members i { background: #fce7f3; color: #be185d; }
        .pf-ql-insurance i { background: #fff7ed; color: #c2410c; }
        .pf-ql-settings i { background: #f1f5f9; color: var(--nd-muted); }

        /* Sidebar meta */
        .pf-sidebar-meta {
            padding: 0.75rem 1.5rem;
            border-top: 1px solid var(--nd-border);
            font-size: 0.75rem; color: var(--nd-faint);
        }
        .pf-sidebar-meta div { display: flex; justify-content: space-between; padding: 0.25rem 0; }
        .pf-sidebar-meta strong { color: var(--nd-muted); }

        /* â”€â”€ VB cards â”€â”€ */
        .pf-vb-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 0.75rem;
        }
        .pf-vb-card {
            display: flex; align-items: center; gap: 0.85rem;
            padding: 0.85rem 1rem;
            border: 1px solid var(--nd-border);
            border-radius: 12px;
            transition: all 0.2s;
        }
        .pf-vb-card:hover {
            border-color: var(--nd-amber);
            box-shadow: 0 3px 10px rgba(217,119,6,0.08);
            transform: translateY(-1px);
        }
        .pf-vb-icon {
            width: 42px; height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--nd-navy), var(--nd-navy-light));
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 1rem; flex-shrink: 0;
        }
        .pf-vb-name { font-size: 0.88rem; font-weight: 700; color: var(--nd-text); margin: 0; }
        .pf-vb-meta { font-size: 0.73rem; color: var(--nd-muted); margin: 0.15rem 0 0; }
        .pf-vb-role {
            padding: 0.15rem 0.55rem; border-radius: 8px;
            font-size: 0.65rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.3px; flex-shrink: 0;
        }
        .pf-vb-role-admin { background: #dcfce7; color: var(--nd-green); }
        .pf-vb-role-member { background: #dbeafe; color: #2563eb; }

        /* â”€â”€ Security Items â”€â”€ */
        .pf-sec-item {
            display: flex; align-items: center; justify-content: space-between;
            gap: 1rem; flex-wrap: wrap;
            padding: 1rem 1.25rem;
            background: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            margin-bottom: 0.75rem;
        }
        .pf-sec-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--nd-navy), var(--nd-navy-light));
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 0.85rem; flex-shrink: 0;
        }
        .pf-sec-title { font-weight: 700; font-size: 0.88rem; color: var(--nd-text); }
        .pf-sec-sub { font-size: 0.78rem; color: var(--nd-muted); margin-top: 1px; }

        /* â”€â”€ Avatar Preview â”€â”€ */
        .pf-avatar-preview {
            background: #f8fafc; border: 2px dashed #e2e8f0; border-radius: 14px;
            padding: 1.5rem; text-align: center;
            margin: 0.75rem 0;
        }
        .pf-avatar-preview img {
            width: 120px; height: 120px; border-radius: 50%;
            object-fit: cover; box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 0.75rem;
        }

        /* â”€â”€ Payment Method Cards â”€â”€ */
        .pf-pm-grid {
            display: flex; flex-direction: column; gap: 0.75rem;
        }
        .pf-pm-card {
            display: flex; align-items: center; gap: 1rem;
            padding: 1rem 1.25rem;
            border: 2px solid var(--nd-border);
            border-radius: 14px;
            transition: all 0.2s;
            position: relative;
        }
        .pf-pm-card:hover {
            border-color: #ddd;
            box-shadow: 0 3px 12px rgba(0,0,0,0.04);
        }
        .pf-pm-card.primary {
            border-color: var(--nd-amber);
            background: #fffbeb;
        }
        .pf-pm-card.inactive { opacity: 0.55; }
        .pf-pm-type-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }
        .pf-pm-type-bank { background: linear-gradient(135deg, var(--nd-navy), var(--nd-navy-light)); color: #fff; }
        .pf-pm-type-momo { background: linear-gradient(135deg, #059669, #34d399); color: #fff; }
        .pf-pm-info { flex: 1; min-width: 0; }
        .pf-pm-title {
            font-weight: 700; font-size: 0.88rem; color: var(--nd-text);
            display: flex; align-items: center; gap: 0.4rem; flex-wrap: wrap;
        }
        .pf-pm-detail { font-size: 0.78rem; color: var(--nd-muted); margin-top: 2px; }
        .pf-pm-badges { display: flex; gap: 0.3rem; flex-wrap: wrap; margin-top: 0.3rem; }
        .pf-pm-badge {
            padding: 0.1rem 0.5rem; border-radius: 6px;
            font-size: 0.62rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .pf-pm-badge-primary { background: #fef3c7; color: #b45309; }
        .pf-pm-badge-bank { background: #dbeafe; color: #1d4ed8; }
        .pf-pm-badge-momo { background: #d1fae5; color: #059669; }
        .pf-pm-badge-inactive { background: #fef2f2; color: var(--nd-red); }
        .pf-pm-actions {
            display: flex; gap: 0.3rem; flex-shrink: 0;
        }
        .pf-pm-action {
            width: 32px; height: 32px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            font-size: 0.72rem;
            color: var(--nd-muted);
            transition: all 0.15s;
        }
        .pf-pm-action:hover { background: #f8fafc; color: var(--nd-navy); border-color: #cbd5e1; }
        .pf-pm-action.star:hover { color: var(--nd-amber); }
        .pf-pm-action.danger:hover { color: var(--nd-red); border-color: #fecaca; background: #fef2f2; }

        /* â”€â”€ Type Toggle â”€â”€ */
        .pf-type-toggle {
            display: flex; gap: 0; border: 2px solid #e2e8f0; border-radius: 12px;
            overflow: hidden; margin-bottom: 1rem;
        }
        .pf-type-toggle button {
            flex: 1; padding: 0.6rem 1rem; border: none; cursor: pointer;
            font-size: 0.82rem; font-weight: 600;
            background: #fff; color: var(--nd-muted);
            transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 0.4rem;
        }
        .pf-type-toggle button:first-child { border-right: 1px solid #e2e8f0; }
        .pf-type-toggle button.active {
            background: var(--nd-navy); color: #fff;
        }

        /* â”€â”€ Documents Tab â”€â”€ */
        .pf-doc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.25rem;
        }
        .pf-doc-card {
            border: 2px solid var(--nd-border);
            border-radius: 14px;
            padding: 1.25rem;
            background: #fafbfd;
            transition: all 0.2s;
        }
        .pf-doc-card:hover { border-color: #d5dae5; }
        .pf-doc-header {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            margin-bottom: 1rem;
        }
        .pf-doc-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.15rem; flex-shrink: 0;
        }
        .pf-doc-icon-nrc {
            background: linear-gradient(135deg, var(--nd-navy), var(--nd-navy-light));
            color: #fff;
        }
        .pf-doc-icon-passport {
            background: linear-gradient(135deg, var(--nd-amber), var(--nd-amber-light));
            color: #fff;
        }
        .pf-doc-title {
            font-size: 0.88rem; font-weight: 700;
            color: var(--nd-text); margin: 0;
        }
        .pf-doc-hint {
            font-size: 0.75rem; color: var(--nd-muted);
            margin: 0.15rem 0 0;
        }
        .pf-doc-dropzone {
            display: flex; flex-direction: column; align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.25s;
            text-align: center;
        }
        .pf-doc-dropzone:hover {
            border-color: var(--nd-amber);
            background: #fffbeb;
        }
        .pf-doc-drop-icon {
            font-size: 2rem; color: #cbd5e1; margin-bottom: 0.5rem;
            transition: color 0.25s;
        }
        .pf-doc-dropzone:hover .pf-doc-drop-icon { color: var(--nd-amber); }
        .pf-doc-drop-text {
            font-size: 0.85rem; font-weight: 600; color: var(--nd-text);
        }
        .pf-doc-drop-hint {
            font-size: 0.72rem; color: var(--nd-faint); margin-top: 0.25rem;
        }
        .pf-doc-preview {
            text-align: center;
        }
        .pf-doc-preview img {
            max-width: 100%; max-height: 220px;
            border-radius: 10px;
            border: 2px solid var(--nd-border);
            object-fit: contain;
            margin-bottom: 0.75rem;
        }
        .pf-doc-preview-actions {
            display: flex; gap: 0.5rem; justify-content: center;
        }
        .pf-doc-existing {
            text-align: center;
        }
        .pf-doc-img {
            max-width: 100%; max-height: 200px;
            border-radius: 10px;
            border: 2px solid var(--nd-border);
            object-fit: contain;
            margin-bottom: 0.65rem;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .pf-doc-img:hover { transform: scale(1.02); }
        .pf-doc-img-passport {
            max-height: 240px;
            border-radius: 8px;
        }
        .pf-doc-existing-actions {
            display: flex; gap: 0.4rem; justify-content: center;
            margin-bottom: 0.5rem;
        }
        .pf-doc-status {
            display: inline-flex; align-items: center; gap: 0.35rem;
            font-size: 0.72rem; font-weight: 700; padding: 0.2rem 0.65rem;
            border-radius: 20px;
        }
        .pf-doc-status-ok { background: #dcfce7; color: #16a34a; }
        .pf-doc-uploading {
            display: flex; align-items: center; gap: 0.5rem;
            justify-content: center;
            margin-top: 0.65rem;
            font-size: 0.78rem; color: var(--nd-amber); font-weight: 600;
        }
        .pf-doc-info {
            display: flex; align-items: flex-start; gap: 0.65rem;
            margin-top: 1.25rem;
            padding: 0.85rem 1rem;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 10px;
            font-size: 0.78rem;
            color: #1e40af;
            line-height: 1.5;
        }
        .pf-doc-info i { font-size: 0.85rem; margin-top: 0.1rem; flex-shrink: 0; }

        @media (max-width: 768px) {
            .pf-grid { padding: 0 0.75rem 1.5rem; gap: 1rem; }
            .pf-doc-grid { grid-template-columns: 1fr; }
        }
    </style>
    @endpush

    <section class="content nd-page">
        {{-- â•â•â•â•â•â•â•â•â•â•â• Hero Banner â•â•â•â•â•â•â•â•â•â•â• --}}
        <div class="nd-hero">
            <div class="nd-hero-inner container-fluid">
                <div>
                    <ul class="nd-breadcrumb">
                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="sep">/</li>
                        <li class="active">My Profile</li>
                    </ul>
                    <h2 class="nd-hero-title" style="margin-top:0.4rem;">My Profile</h2>
                    <p class="nd-hero-sub">Manage your personal information and settings</p>
                </div>
                <div class="d-none d-md-flex" style="gap:0.5rem;">
                    @if(!$editing)
                        <button wire:click="startEditing" class="nd-btn nd-btn-amber">
                            <i class="fas fa-pen"></i> Edit Profile
                        </button>
                    @endif
                    <button wire:click="openPasswordModal" class="nd-btn nd-btn-ghost" style="border-color:rgba(255,255,255,0.2);color:rgba(255,255,255,0.8);">
                        <i class="fas fa-lock"></i> Password
                    </button>
                </div>
            </div>
        </div>

        {{-- â•â•â•â•â•â•â•â•â•â•â• Two Column Grid â•â•â•â•â•â•â•â•â•â•â• --}}
        <div class="pf-grid container-fluid">

            {{-- â•â•â•â•â•â•â•â• LEFT SIDEBAR â•â•â•â•â•â•â•â• --}}
            <div>
                <div class="nd-card">
                    {{-- Avatar + Identity --}}
                    <div class="pf-sidebar-top">
                        <div class="pf-avatar-wrap">
                            <img src="{{ $avatarUrl }}" alt="Profile" class="pf-avatar"
                                 onerror="this.onerror=null; this.src='{{ asset('img/default-avatar.svg') }}';">
                            <label for="pf-avatar-input" class="pf-avatar-badge" title="Change Photo">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" id="pf-avatar-input" wire:model="avatarUpload" accept="image/*" style="display:none;">
                        </div>
                        <h4 class="pf-sidebar-name">{{ $name }}</h4>
                        <p class="pf-sidebar-email">{{ $email }}</p>
                        <span class="pf-role-chip">
                            <i class="fas fa-shield-alt" style="font-size:0.6rem;"></i>
                            {{ $userRoleName }}
                        </span>
                    </div>

                    {{-- Avatar Preview --}}
                    @if($avatarPreview)
                        <div class="pf-avatar-preview">
                            <img src="{{ $avatarPreview }}" alt="Preview">
                            <div style="display:flex;gap:0.5rem;justify-content:center;">
                                <button wire:click="saveAvatar" class="nd-btn nd-btn-amber"><i class="fas fa-check"></i> Save</button>
                                <button wire:click="cancelAvatarUpload" class="nd-btn nd-btn-ghost"><i class="fas fa-times"></i> Cancel</button>
                            </div>
                            @error('avatarUpload') <p style="color:var(--nd-red);font-size:0.78rem;margin-top:0.4rem;">{{ $message }}</p> @enderror
                        </div>
                    @endif

                    {{-- Stats --}}
                    <div class="pf-sidebar-stats">
                        <div class="pf-sidebar-stat">
                            <div class="pf-stat-num">{{ $stats['banks'] }}</div>
                            <div class="pf-stat-lbl">Banks</div>
                        </div>
                        <div class="pf-sidebar-stat">
                            <div class="pf-stat-num">{{ $stats['circles'] }}</div>
                            <div class="pf-stat-lbl">Circles</div>
                        </div>
                        <div class="pf-sidebar-stat">
                            <div class="pf-stat-num">{{ $stats['loans'] }}</div>
                            <div class="pf-stat-lbl">Loans</div>
                        </div>
                    </div>

                    {{-- Navigation Tabs --}}
                    <div class="pf-sidebar-nav">
                        <button wire:click="switchTab('overview')" class="pf-sidebar-link {{ $activeTab === 'overview' ? 'active' : '' }}">
                            <i class="fas fa-user"></i> Overview
                        </button>
                        <button wire:click="switchTab('employment')" class="pf-sidebar-link {{ $activeTab === 'employment' ? 'active' : '' }}">
                            <i class="fas fa-briefcase"></i> Employment
                        </button>
                        <button wire:click="switchTab('address')" class="pf-sidebar-link {{ $activeTab === 'address' ? 'active' : '' }}">
                            <i class="fas fa-map-marker-alt"></i> Address & NOK
                        </button>
                        <button wire:click="switchTab('banks')" class="pf-sidebar-link {{ $activeTab === 'banks' ? 'active' : '' }}">
                            <i class="fas fa-university"></i> Village Banks
                        </button>
                        <button wire:click="switchTab('payments')" class="pf-sidebar-link {{ $activeTab === 'payments' ? 'active' : '' }}">
                            <i class="fas fa-credit-card"></i> Payment Methods
                        </button>
                        <button wire:click="switchTab('documents')" class="pf-sidebar-link {{ $activeTab === 'documents' ? 'active' : '' }}">
                            <i class="fas fa-id-card"></i> Documents
                        </button>
                        <button wire:click="switchTab('security')" class="pf-sidebar-link {{ $activeTab === 'security' ? 'active' : '' }}">
                            <i class="fas fa-shield-alt"></i> Security
                        </button>
                    </div>

                    {{-- Quick Links --}}
                    <div class="pf-quicklinks">
                        <div class="pf-quicklinks-title"><i class="fas fa-external-link-alt"></i> Quick Links</div>
                        <div class="pf-quicklinks-grid">
                            <a href="{{ route('home') }}" class="pf-quicklink pf-ql-dashboard">
                                <i class="fas fa-th-large"></i> Dashboard
                            </a>
                            <a href="{{ route('village-banks.index') }}" class="pf-quicklink pf-ql-vb">
                                <i class="fas fa-university"></i> Village Banks
                            </a>
                            <a href="{{ route('loans.index') }}" class="pf-quicklink pf-ql-loans">
                                <i class="fas fa-hand-holding-usd"></i> My Loans
                            </a>
                            <a href="{{ route('shares.index') }}" class="pf-quicklink pf-ql-shares">
                                <i class="fas fa-coins"></i> My Shares
                            </a>
                            <a href="{{ route('repayments.index') }}" class="pf-quicklink pf-ql-repay">
                                <i class="fas fa-redo"></i> Repayments
                            </a>
                            <a href="{{ route('insurance.index') }}" class="pf-quicklink pf-ql-insurance">
                                <i class="fas fa-shield-alt"></i> Insurance
                            </a>
                            <a href="{{ route('members.index') }}" class="pf-quicklink pf-ql-members">
                                <i class="fas fa-users"></i> Members
                            </a>
                            <a href="{{ route('settings.bank-config') }}" class="pf-quicklink pf-ql-settings">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                        </div>
                    </div>

                    {{-- Footer Meta --}}
                    <div class="pf-sidebar-meta">
                        <div><span>Member since</span> <strong>{{ $memberSince }}</strong></div>
                        <div><span>Total logins</span> <strong>{{ $totalLogins }}</strong></div>
                    </div>
                </div>

                {{-- Mobile edit buttons --}}
                <div class="d-md-none" style="margin-top:0.75rem;display:flex;gap:0.5rem;">
                    @if(!$editing)
                        <button wire:click="startEditing" class="nd-btn nd-btn-amber" style="flex:1;justify-content:center;">
                            <i class="fas fa-pen"></i> Edit
                        </button>
                    @endif
                    <button wire:click="openPasswordModal" class="nd-btn nd-btn-ghost" style="flex:1;justify-content:center;">
                        <i class="fas fa-lock"></i> Password
                    </button>
                </div>
            </div>

            {{-- â•â•â•â•â•â•â•â• RIGHT CONTENT â•â•â•â•â•â•â•â• --}}
            <div>
                {{-- Flash --}}
                @if(session()->has('profile_success'))
                    <div class="nd-flash nd-flash-success">
                        <i class="fas fa-check-circle"></i> {{ session('profile_success') }}
                    </div>
                @endif

                {{-- â•â•â•â•â•â• TAB: Overview â•â•â•â•â•â• --}}
                @if($activeTab === 'overview')
                    @if($editing)
                        {{-- EDIT MODE --}}
                        <div class="nd-card">
                            <div class="nd-card-head">
                                <h3 class="nd-card-title"><i class="fas fa-edit"></i> Edit Personal Information</h3>
                            </div>
                            <div class="nd-card-body">
                                <div class="nd-row nd-row-auto">
                                    <div class="nd-field">
                                        <label>Full Name <span class="req">*</span></label>
                                        <input type="text" wire:model.defer="name" placeholder="Enter full name">
                                        @error('name') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Email <span class="req">*</span></label>
                                        <input type="email" wire:model.defer="email" placeholder="Enter email">
                                        @error('email') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Username</label>
                                        <input type="text" wire:model.defer="username" placeholder="Enter username">
                                        @error('username') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Phone</label>
                                        <input type="text" wire:model.defer="phone" placeholder="0977 123 456">
                                        @error('phone') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Mobile</label>
                                        <input type="text" wire:model.defer="mobileNo" placeholder="0966 789 012">
                                        @error('mobileNo') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="nd-card">
                            <div class="nd-card-head">
                                <h3 class="nd-card-title"><i class="fas fa-fingerprint"></i> Identity Details</h3>
                            </div>
                            <div class="nd-card-body">
                                <div class="nd-row nd-row-auto">
                                    <div class="nd-field">
                                        <label>Date of Birth</label>
                                        <input type="date" wire:model.defer="dateOfBirth">
                                        @error('dateOfBirth') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Gender</label>
                                        <select wire:model.defer="gender">
                                            <option value="">Select</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        @error('gender') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>National ID / NRC</label>
                                        <input type="text" wire:model.defer="nationalId" placeholder="123456/78/1">
                                        @error('nationalId') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div style="display:flex;gap:0.5rem;margin-top:1rem;">
                                    <button wire:click="saveProfile" class="nd-btn nd-btn-amber">
                                        <i class="fas fa-check"></i> Save Changes
                                    </button>
                                    <button wire:click="cancelEditing" class="nd-btn nd-btn-ghost">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- VIEW MODE --}}
                        <div class="nd-card">
                            <div class="nd-card-head">
                                <h3 class="nd-card-title"><i class="fas fa-user"></i> Personal Information</h3>
                                <button wire:click="startEditing" class="nd-btn nd-btn-ghost" style="padding:0.3rem 0.8rem;font-size:0.75rem;">
                                    <i class="fas fa-pen"></i> Edit
                                </button>
                            </div>
                            <div class="nd-card-body">
                                <div class="nd-info-row">
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-user"></i> Full Name</div>
                                        <div class="nd-info-val">{{ $name }}</div>
                                    </div>
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-envelope"></i> Email</div>
                                        <div class="nd-info-val">{{ $email }}</div>
                                    </div>
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-at"></i> Username</div>
                                        <div class="nd-info-val {{ empty($username) ? 'empty' : '' }}">{{ $username ?: 'Not set' }}</div>
                                    </div>
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-phone"></i> Phone</div>
                                        <div class="nd-info-val {{ empty($phone) ? 'empty' : '' }}">{{ $phone ?: 'Not set' }}</div>
                                    </div>
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-mobile-alt"></i> Mobile</div>
                                        <div class="nd-info-val {{ empty($mobileNo) ? 'empty' : '' }}">{{ $mobileNo ?: 'Not set' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="nd-card">
                            <div class="nd-card-head">
                                <h3 class="nd-card-title"><i class="fas fa-fingerprint"></i> Identity Details</h3>
                            </div>
                            <div class="nd-card-body">
                                <div class="nd-info-row">
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-calendar"></i> Date of Birth</div>
                                        <div class="nd-info-val {{ empty($dateOfBirth) ? 'empty' : '' }}">
                                            {{ $dateOfBirth ? \Carbon\Carbon::parse($dateOfBirth)->format('M d, Y') : 'Not set' }}
                                        </div>
                                    </div>
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-venus-mars"></i> Gender</div>
                                        <div class="nd-info-val {{ empty($gender) ? 'empty' : '' }}">{{ $gender ? ucfirst($gender) : 'Not set' }}</div>
                                    </div>
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-id-badge"></i> National ID / NRC</div>
                                        <div class="nd-info-val {{ empty($nationalId) ? 'empty' : '' }}">{{ $nationalId ?: 'Not set' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                {{-- â•â•â•â•â•â• TAB: Employment â•â•â•â•â•â• --}}
                @if($activeTab === 'employment')
                    @if($editing)
                        <div class="nd-card">
                            <div class="nd-card-head">
                                <h3 class="nd-card-title"><i class="fas fa-briefcase"></i> Edit Employment Details</h3>
                            </div>
                            <div class="nd-card-body">
                                <div class="nd-row nd-row-auto">
                                    <div class="nd-field">
                                        <label>Employment Status</label>
                                        <select wire:model.defer="employmentStatus">
                                            <option value="">Select status</option>
                                            <option value="employed">Employed</option>
                                            <option value="self_employed">Self Employed</option>
                                            <option value="unemployed">Unemployed</option>
                                            <option value="student">Student</option>
                                            <option value="retired">Retired</option>
                                        </select>
                                        @error('employmentStatus') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Job Title / Occupation</label>
                                        <input type="text" wire:model.defer="jobTitle" placeholder="e.g. Accountant">
                                        @error('jobTitle') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Company / Employer</label>
                                        <input type="text" wire:model.defer="companyName" placeholder="e.g. ABC Limited">
                                        @error('companyName') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Company Location</label>
                                        <input type="text" wire:model.defer="companyLocation" placeholder="e.g. Lusaka, Cairo Road">
                                        @error('companyLocation') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div style="display:flex;gap:0.5rem;margin-top:1rem;">
                                    <button wire:click="saveProfile" class="nd-btn nd-btn-amber"><i class="fas fa-check"></i> Save Changes</button>
                                    <button wire:click="cancelEditing" class="nd-btn nd-btn-ghost"><i class="fas fa-times"></i> Cancel</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="nd-card">
                            <div class="nd-card-head">
                                <h3 class="nd-card-title"><i class="fas fa-briefcase"></i> Employment</h3>
                                <button wire:click="startEditing" class="nd-btn nd-btn-ghost" style="padding:0.3rem 0.8rem;font-size:0.75rem;">
                                    <i class="fas fa-pen"></i> Edit
                                </button>
                            </div>
                            <div class="nd-card-body">
                                <div class="nd-info-row">
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-user-tie"></i> Status</div>
                                        <div class="nd-info-val {{ empty($employmentStatus) ? 'empty' : '' }}">
                                            @if($employmentStatus)
                                                <span style="display:inline-flex;align-items:center;gap:0.3rem;padding:0.15rem 0.6rem;border-radius:8px;font-size:0.78rem;font-weight:600;
                                                    {{ $employmentStatus === 'employed' ? 'background:#dcfce7;color:#16a34a;' : '' }}
                                                    {{ $employmentStatus === 'self_employed' ? 'background:#dbeafe;color:#2563eb;' : '' }}
                                                    {{ $employmentStatus === 'unemployed' ? 'background:#fef2f2;color:#dc2626;' : '' }}
                                                    {{ $employmentStatus === 'student' ? 'background:#f5f3ff;color:#7c3aed;' : '' }}
                                                    {{ $employmentStatus === 'retired' ? 'background:#fefce8;color:#ca8a04;' : '' }}
                                                ">
                                                    {{ str_replace('_', ' ', ucfirst($employmentStatus)) }}
                                                </span>
                                            @else
                                                Not set
                                            @endif
                                        </div>
                                    </div>
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-briefcase"></i> Job Title</div>
                                        <div class="nd-info-val {{ empty($jobTitle) ? 'empty' : '' }}">{{ $jobTitle ?: 'Not set' }}</div>
                                    </div>
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-building"></i> Company</div>
                                        <div class="nd-info-val {{ empty($companyName) ? 'empty' : '' }}">{{ $companyName ?: 'Not set' }}</div>
                                    </div>
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-map-pin"></i> Location</div>
                                        <div class="nd-info-val {{ empty($companyLocation) ? 'empty' : '' }}">{{ $companyLocation ?: 'Not set' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                {{-- â•â•â•â•â•â• TAB: Address & NOK â•â•â•â•â•â• --}}
                @if($activeTab === 'address')
                    @if($editing)
                        <div class="nd-card">
                            <div class="nd-card-head">
                                <h3 class="nd-card-title"><i class="fas fa-home"></i> Edit Home Address</h3>
                            </div>
                            <div class="nd-card-body">
                                <div class="nd-row nd-row-auto">
                                    <div class="nd-field">
                                        <label>Country</label>
                                        <input type="text" wire:model.defer="country" placeholder="e.g. Zambia">
                                        @error('country') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Province / State</label>
                                        <input type="text" wire:model.defer="province" placeholder="e.g. Lusaka Province">
                                        @error('province') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>City / Town</label>
                                        <input type="text" wire:model.defer="city" placeholder="e.g. Lusaka">
                                        @error('city') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Home Address</label>
                                        <textarea wire:model.defer="homeAddress" placeholder="e.g. Plot 123, Kabulonga Road"></textarea>
                                        @error('homeAddress') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nd-card">
                            <div class="nd-card-head">
                                <h3 class="nd-card-title"><i class="fas fa-user-friends"></i> Edit Next of Kin</h3>
                            </div>
                            <div class="nd-card-body">
                                <div class="nd-row nd-row-auto">
                                    <div class="nd-field">
                                        <label>Full Name</label>
                                        <input type="text" wire:model.defer="nokName" placeholder="e.g. Mary Banda">
                                        @error('nokName') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Relationship</label>
                                        <select wire:model.defer="nokRelationship">
                                            <option value="">Select</option>
                                            <option value="spouse">Spouse</option>
                                            <option value="parent">Parent</option>
                                            <option value="child">Child (Adult)</option>
                                            <option value="sibling">Sibling</option>
                                            <option value="relative">Other Relative</option>
                                            <option value="friend">Friend</option>
                                        </select>
                                        @error('nokRelationship') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Contact Phone</label>
                                        <input type="text" wire:model.defer="nokContact" placeholder="0977 999 888">
                                        @error('nokContact') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="nd-field">
                                        <label>Address</label>
                                        <textarea wire:model.defer="nokAddress" placeholder="e.g. Chilenje South, Lusaka"></textarea>
                                        @error('nokAddress') <div class="err">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div style="display:flex;gap:0.5rem;margin-top:1rem;">
                                    <button wire:click="saveProfile" class="nd-btn nd-btn-amber"><i class="fas fa-check"></i> Save Changes</button>
                                    <button wire:click="cancelEditing" class="nd-btn nd-btn-ghost"><i class="fas fa-times"></i> Cancel</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="nd-card">
                            <div class="nd-card-head">
                                <h3 class="nd-card-title"><i class="fas fa-home"></i> Home Address</h3>
                                <button wire:click="startEditing" class="nd-btn nd-btn-ghost" style="padding:0.3rem 0.8rem;font-size:0.75rem;">
                                    <i class="fas fa-pen"></i> Edit
                                </button>
                            </div>
                            <div class="nd-card-body">
                                <div class="nd-info-row">
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-globe-africa"></i> Country</div>
                                        <div class="nd-info-val {{ empty($country) ? 'empty' : '' }}">{{ $country ?: 'Not set' }}</div>
                                    </div>
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-map"></i> Province</div>
                                        <div class="nd-info-val {{ empty($province) ? 'empty' : '' }}">{{ $province ?: 'Not set' }}</div>
                                    </div>
                                    <div class="nd-info-item">
                                        <div class="nd-info-lbl"><i class="fas fa-city"></i> City / Town</div>
                                        <div class="nd-info-val {{ empty($city) ? 'empty' : '' }}">{{ $city ?: 'Not set' }}</div>
                                    </div>
                                    <div class="nd-info-item" style="grid-column: 1 / -1;">
                                        <div class="nd-info-lbl"><i class="fas fa-map-marker-alt"></i> Full Address</div>
                                        <div class="nd-info-val {{ empty($homeAddress) ? 'empty' : '' }}">{{ $homeAddress ?: 'Not set' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="nd-card">
                            <div class="nd-card-head">
                                <h3 class="nd-card-title"><i class="fas fa-user-friends"></i> Next of Kin</h3>
                            </div>
                            <div class="nd-card-body">
                                @if(!empty($nokName))
                                    <div style="display:flex;align-items:center;gap:1rem;padding:1rem;background:#f8fafc;border-radius:14px;border:1px solid #f1f5f9;margin-bottom:0.75rem;">
                                        <div style="width:50px;height:50px;border-radius:50%;background:linear-gradient(135deg,var(--nd-navy),var(--nd-navy-light));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:1rem;flex-shrink:0;">
                                            @php
                                                $np = explode(' ', trim($nokName));
                                                $ni = strtoupper(substr($np[0],0,1) . (isset($np[1]) ? substr($np[1],0,1) : ''));
                                            @endphp
                                            {{ $ni }}
                                        </div>
                                        <div style="flex:1;">
                                            <div style="font-weight:700;font-size:0.95rem;color:var(--nd-text);">{{ $nokName }}</div>
                                            @if($nokRelationship)
                                                <span style="font-size:0.75rem;padding:0.1rem 0.5rem;border-radius:6px;background:#f5f3ff;color:#7c3aed;font-weight:600;">{{ ucfirst($nokRelationship) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="nd-info-row">
                                        <div class="nd-info-item">
                                            <div class="nd-info-lbl"><i class="fas fa-phone-alt"></i> Contact</div>
                                            <div class="nd-info-val {{ empty($nokContact) ? 'empty' : '' }}">{{ $nokContact ?: 'Not set' }}</div>
                                        </div>
                                        <div class="nd-info-item">
                                            <div class="nd-info-lbl"><i class="fas fa-map-marker-alt"></i> Address</div>
                                            <div class="nd-info-val {{ empty($nokAddress) ? 'empty' : '' }}">{{ $nokAddress ?: 'Not set' }}</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="nd-empty">
                                        <i class="fas fa-user-friends"></i>
                                        <strong>No Next of Kin</strong>
                                        <span style="font-size:0.82rem;">Click Edit Profile to add your emergency contact.</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endif

                {{-- â•â•â•â•â•â• TAB: Village Banks â•â•â•â•â•â• --}}
                @if($activeTab === 'banks')
                    <div class="nd-card">
                        <div class="nd-card-head">
                            <h3 class="nd-card-title"><i class="fas fa-university"></i> Village Bank Memberships</h3>
                            <span style="font-size:0.75rem;color:var(--nd-muted);font-weight:600;">{{ $villageBanks->count() }} bank(s)</span>
                        </div>
                        <div class="nd-card-body">
                            @if($villageBanks->count() > 0)
                                <div class="pf-vb-grid">
                                    @foreach($villageBanks as $bank)
                                        <div class="pf-vb-card">
                                            <div class="pf-vb-icon"><i class="fas fa-university"></i></div>
                                            <div style="flex:1;min-width:0;">
                                                <h5 class="pf-vb-name">{{ $bank->name }}</h5>
                                                <p class="pf-vb-meta">
                                                    @if($bank->code)
                                                        <i class="fas fa-tag" style="font-size:0.6rem;"></i> {{ $bank->code }} &bull;
                                                    @endif
                                                    <i class="fas fa-users" style="font-size:0.6rem;"></i> {{ $bank->members()->count() }} members
                                                    &bull; Joined {{ $bank->pivot->joined_at ? \Carbon\Carbon::parse($bank->pivot->joined_at)->format('M Y') : 'N/A' }}
                                                </p>
                                            </div>
                                            <span class="pf-vb-role {{ ($bank->pivot->role ?? '') === 'admin' ? 'pf-vb-role-admin' : 'pf-vb-role-member' }}">
                                                {{ ucfirst($bank->pivot->role ?? 'member') }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="nd-empty">
                                    <i class="fas fa-university"></i>
                                    <strong>No Village Banks</strong>
                                    <span style="font-size:0.82rem;">You are not currently a member of any village bank.</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- â•â•â•â•â•â• TAB: Payment Methods â•â•â•â•â•â• --}}
                @if($activeTab === 'payments')
                    <div class="nd-card">
                        <div class="nd-card-head">
                            <h3 class="nd-card-title"><i class="fas fa-credit-card"></i> Payment Methods</h3>
                            <button wire:click="openPaymentModal" class="nd-btn nd-btn-amber" style="padding:0.35rem 0.9rem;font-size:0.78rem;">
                                <i class="fas fa-plus"></i> Add Method
                            </button>
                        </div>
                        <div class="nd-card-body">
                            @if($paymentMethods->count() > 0)
                                <div class="pf-pm-grid">
                                    @foreach($paymentMethods as $pm)
                                        <div class="pf-pm-card {{ $pm->is_primary ? 'primary' : '' }} {{ $pm->status === 'inactive' ? 'inactive' : '' }}">
                                            <div class="pf-pm-type-icon {{ $pm->type === 'bank' ? 'pf-pm-type-bank' : 'pf-pm-type-momo' }}">
                                                <i class="{{ $pm->type === 'bank' ? 'fas fa-university' : 'fas fa-mobile-alt' }}"></i>
                                            </div>
                                            <div class="pf-pm-info">
                                                <div class="pf-pm-title">
                                                    @if($pm->type === 'bank')
                                                        {{ $pm->bank_name }}
                                                    @else
                                                        {{ $pm->provider }}
                                                    @endif
                                                    @if($pm->label)
                                                        <span style="font-weight:400;color:var(--nd-faint);font-size:0.78rem;">({{ $pm->label }})</span>
                                                    @endif
                                                </div>
                                                <div class="pf-pm-detail">
                                                    @if($pm->type === 'bank')
                                                        {{ $pm->account_name }} &bull; ****{{ substr($pm->account_number, -4) }}
                                                        @if($pm->branch_name)
                                                            &bull; {{ $pm->branch_name }}
                                                        @endif
                                                    @else
                                                        {{ $pm->registered_name }} &bull; {{ $pm->mobile_number }}
                                                    @endif
                                                </div>
                                                <div class="pf-pm-badges">
                                                    @if($pm->is_primary)
                                                        <span class="pf-pm-badge pf-pm-badge-primary"><i class="fas fa-star" style="font-size:0.5rem;"></i> Primary</span>
                                                    @endif
                                                    <span class="pf-pm-badge {{ $pm->type === 'bank' ? 'pf-pm-badge-bank' : 'pf-pm-badge-momo' }}">
                                                        {{ $pm->type === 'bank' ? 'Bank' : 'Mobile Money' }}
                                                    </span>
                                                    @if($pm->currency !== 'ZMW')
                                                        <span class="pf-pm-badge" style="background:#f3f4f6;color:var(--nd-muted);">{{ $pm->currency }}</span>
                                                    @endif
                                                    @if($pm->status === 'inactive')
                                                        <span class="pf-pm-badge pf-pm-badge-inactive">Inactive</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="pf-pm-actions">
                                                @if(!$pm->is_primary && $pm->status === 'active')
                                                    <button wire:click="setPrimaryPayment({{ $pm->id }})" class="pf-pm-action star" title="Set as Primary">
                                                        <i class="fas fa-star"></i>
                                                    </button>
                                                @endif
                                                <button wire:click="openPaymentModal({{ $pm->id }})" class="pf-pm-action" title="Edit">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button wire:click="togglePaymentStatus({{ $pm->id }})" class="pf-pm-action" title="{{ $pm->status === 'active' ? 'Deactivate' : 'Activate' }}">
                                                    <i class="fas {{ $pm->status === 'active' ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                                </button>
                                                <button wire:click="deletePaymentMethod({{ $pm->id }})" class="pf-pm-action danger" title="Delete"
                                                        onclick="return confirm('Delete this payment method?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="nd-empty">
                                    <i class="fas fa-credit-card"></i>
                                    <strong>No Payment Methods</strong>
                                    <span style="font-size:0.82rem;">Add a bank account or mobile money number so others can send you payments.</span>
                                    <div style="margin-top:0.75rem;">
                                        <button wire:click="openPaymentModal" class="nd-btn nd-btn-amber">
                                            <i class="fas fa-plus"></i> Add Payment Method
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- â•â•â•â•â•â• TAB: Documents â•â•â•â•â•â• --}}
                @if($activeTab === 'documents')
                    <div class="nd-card">
                        <div class="nd-card-head">
                            <h3 class="nd-card-title"><i class="fas fa-id-card"></i> Identity Documents</h3>
                            <span style="font-size:0.75rem;color:var(--nd-muted);font-weight:600;">NRC &amp; Passport Photo</span>
                        </div>
                        <div class="nd-card-body">
                            <div class="pf-doc-grid">

                                {{-- NRC Photo --}}
                                <div class="pf-doc-card">
                                    <div class="pf-doc-header">
                                        <div class="pf-doc-icon pf-doc-icon-nrc">
                                            <i class="fas fa-id-badge"></i>
                                        </div>
                                        <div>
                                            <h4 class="pf-doc-title">NRC (National Registration Card)</h4>
                                            <p class="pf-doc-hint">Upload a clear photo or scan of your NRC</p>
                                        </div>
                                    </div>

                                    @if($nrcPreview)
                                        {{-- Preview before save --}}
                                        <div class="pf-doc-preview">
                                            <img src="{{ $nrcPreview }}" alt="NRC Preview">
                                            <div class="pf-doc-preview-actions">
                                                <button wire:click="saveNrcPhoto" class="nd-btn nd-btn-amber">
                                                    <i class="fas fa-check"></i> Save
                                                </button>
                                                <button wire:click="cancelNrcUpload" class="nd-btn nd-btn-ghost">
                                                    <i class="fas fa-times"></i> Cancel
                                                </button>
                                            </div>
                                        </div>
                                    @elseif($nrcPhotoUrl)
                                        {{-- Existing photo --}}
                                        <div class="pf-doc-existing">
                                            <img src="{{ $nrcPhotoUrl }}" alt="NRC Photo" class="pf-doc-img">
                                            <div class="pf-doc-existing-actions">
                                                <label for="pf-nrc-replace" class="nd-btn nd-btn-navy" style="cursor:pointer;margin:0;">
                                                    <i class="fas fa-sync-alt"></i> Replace
                                                </label>
                                                <input type="file" id="pf-nrc-replace" wire:model="nrcUpload" accept="image/*" style="display:none;">
                                                <button wire:click="removeNrcPhoto" class="nd-btn nd-btn-danger"
                                                        onclick="return confirm('Remove your NRC photo?')">
                                                    <i class="fas fa-trash-alt"></i> Remove
                                                </button>
                                            </div>
                                            <div class="pf-doc-status pf-doc-status-ok">
                                                <i class="fas fa-check-circle"></i> Uploaded
                                            </div>
                                        </div>
                                    @else
                                        {{-- Upload zone --}}
                                        <label for="pf-nrc-upload" class="pf-doc-dropzone">
                                            <input type="file" id="pf-nrc-upload" wire:model="nrcUpload" accept="image/*" style="display:none;">
                                            <div class="pf-doc-drop-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                            <div class="pf-doc-drop-text">Click to upload NRC photo</div>
                                            <div class="pf-doc-drop-hint">JPG, PNG, WebP &bull; Max 3MB</div>
                                        </label>
                                    @endif
                                    @error('nrcUpload') <div class="err" style="margin-top:0.5rem;">{{ $message }}</div> @enderror

                                    <div wire:loading wire:target="nrcUpload" class="pf-doc-uploading">
                                        <div class="nd-spinner" style="width:16px;height:16px;border-width:2px;"></div>
                                        <span>Uploading...</span>
                                    </div>
                                </div>

                                {{-- Passport Photo --}}
                                <div class="pf-doc-card">
                                    <div class="pf-doc-header">
                                        <div class="pf-doc-icon pf-doc-icon-passport">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                        <div>
                                            <h4 class="pf-doc-title">Passport-Sized Photo</h4>
                                            <p class="pf-doc-hint">Upload a recent passport-sized photograph</p>
                                        </div>
                                    </div>

                                    @if($passportPreview)
                                        {{-- Preview before save --}}
                                        <div class="pf-doc-preview">
                                            <img src="{{ $passportPreview }}" alt="Passport Preview">
                                            <div class="pf-doc-preview-actions">
                                                <button wire:click="savePassportPhoto" class="nd-btn nd-btn-amber">
                                                    <i class="fas fa-check"></i> Save
                                                </button>
                                                <button wire:click="cancelPassportUpload" class="nd-btn nd-btn-ghost">
                                                    <i class="fas fa-times"></i> Cancel
                                                </button>
                                            </div>
                                        </div>
                                    @elseif($passportPhotoUrl)
                                        {{-- Existing photo --}}
                                        <div class="pf-doc-existing">
                                            <img src="{{ $passportPhotoUrl }}" alt="Passport Photo" class="pf-doc-img pf-doc-img-passport">
                                            <div class="pf-doc-existing-actions">
                                                <label for="pf-passport-replace" class="nd-btn nd-btn-navy" style="cursor:pointer;margin:0;">
                                                    <i class="fas fa-sync-alt"></i> Replace
                                                </label>
                                                <input type="file" id="pf-passport-replace" wire:model="passportUpload" accept="image/*" style="display:none;">
                                                <button wire:click="removePassportPhoto" class="nd-btn nd-btn-danger"
                                                        onclick="return confirm('Remove your passport photo?')">
                                                    <i class="fas fa-trash-alt"></i> Remove
                                                </button>
                                            </div>
                                            <div class="pf-doc-status pf-doc-status-ok">
                                                <i class="fas fa-check-circle"></i> Uploaded
                                            </div>
                                        </div>
                                    @else
                                        {{-- Upload zone --}}
                                        <label for="pf-passport-upload" class="pf-doc-dropzone">
                                            <input type="file" id="pf-passport-upload" wire:model="passportUpload" accept="image/*" style="display:none;">
                                            <div class="pf-doc-drop-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                            <div class="pf-doc-drop-text">Click to upload passport photo</div>
                                            <div class="pf-doc-drop-hint">JPG, PNG, WebP &bull; Max 3MB</div>
                                        </label>
                                    @endif
                                    @error('passportUpload') <div class="err" style="margin-top:0.5rem;">{{ $message }}</div> @enderror

                                    <div wire:loading wire:target="passportUpload" class="pf-doc-uploading">
                                        <div class="nd-spinner" style="width:16px;height:16px;border-width:2px;"></div>
                                        <span>Uploading...</span>
                                    </div>
                                </div>

                            </div>

                            {{-- Info note --}}
                            <div class="pf-doc-info">
                                <i class="fas fa-info-circle"></i>
                                <span>Your documents are stored securely and are only accessible to authorised administrators. Accepted formats: JPG, PNG, WebP (max 3MB each).</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- â•â•â•â•â•â• TAB: Security â•â•â•â•â•â• --}}
                @if($activeTab === 'security')
                    <div class="nd-card">
                        <div class="nd-card-head">
                            <h3 class="nd-card-title"><i class="fas fa-shield-alt"></i> Security Settings</h3>
                        </div>
                        <div class="nd-card-body">
                            {{-- Password --}}
                            <div class="pf-sec-item">
                                <div style="display:flex;align-items:center;gap:0.85rem;">
                                    <div class="pf-sec-icon"><i class="fas fa-key"></i></div>
                                    <div>
                                        <div class="pf-sec-title">Password</div>
                                        <div class="pf-sec-sub">
                                            Last changed: {{ Auth::user()->password_changed ? \Carbon\Carbon::parse(Auth::user()->password_changed)->diffForHumans() : 'Never' }}
                                        </div>
                                    </div>
                                </div>
                                <button wire:click="openPasswordModal" class="nd-btn nd-btn-navy"><i class="fas fa-lock"></i> Change</button>
                            </div>

                            {{-- Session --}}
                            <div class="pf-sec-item">
                                <div style="display:flex;align-items:center;gap:0.85rem;">
                                    <div class="pf-sec-icon"><i class="fas fa-desktop"></i></div>
                                    <div>
                                        <div class="pf-sec-title">Active Session</div>
                                        <div class="pf-sec-sub">Started {{ now()->format('M d, Y h:i A') }}</div>
                                    </div>
                                </div>
                                <span style="padding:0.25rem 0.7rem;border-radius:20px;font-size:0.7rem;font-weight:700;background:#dcfce7;color:#16a34a;">
                                    <i class="fas fa-circle" style="font-size:0.4rem;vertical-align:middle;"></i> Active
                                </span>
                            </div>

                            {{-- Profile picture --}}
                            <div class="pf-sec-item">
                                <div style="display:flex;align-items:center;gap:0.85rem;">
                                    <div class="pf-sec-icon"><i class="fas fa-image"></i></div>
                                    <div>
                                        <div class="pf-sec-title">Profile Picture</div>
                                        <div class="pf-sec-sub">JPG, PNG, WebP &bull; Max 2MB</div>
                                    </div>
                                </div>
                                <div style="display:flex;gap:0.4rem;">
                                    <label for="pf-avatar-sec" class="nd-btn nd-btn-amber" style="cursor:pointer;margin:0;">
                                        <i class="fas fa-upload"></i> Upload
                                    </label>
                                    <input type="file" id="pf-avatar-sec" wire:model="avatarUpload" accept="image/*" style="display:none;">
                                    @if(Auth::user()->avatar)
                                        <button wire:click="removeAvatar" class="nd-btn nd-btn-danger"
                                                onclick="return confirm('Remove your profile picture?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div> {{-- end right content --}}
        </div> {{-- end pf-grid --}}
    </section>

    {{-- â•â•â•â•â•â•â•â•â•â•â• Payment Method Modal â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($showPaymentModal)
        <div class="nd-overlay" wire:click.self="closePaymentModal">
            <div class="nd-modal" style="max-width:500px;">
                <div class="nd-modal-head">
                    <h4><i class="fas fa-credit-card mr-2"></i> {{ $editingPaymentId ? 'Edit' : 'Add' }} Payment Method</h4>
                    <button wire:click="closePaymentModal" style="background:none;border:none;color:rgba(255,255,255,0.7);cursor:pointer;font-size:1rem;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="nd-modal-body">
                    {{-- Type Toggle --}}
                    <div class="pf-type-toggle">
                        <button wire:click="$set('pmType', 'bank')" class="{{ $pmType === 'bank' ? 'active' : '' }}">
                            <i class="fas fa-university"></i> Bank Account
                        </button>
                        <button wire:click="$set('pmType', 'mobile_money')" class="{{ $pmType === 'mobile_money' ? 'active' : '' }}">
                            <i class="fas fa-mobile-alt"></i> Mobile Money
                        </button>
                    </div>

                    {{-- Label --}}
                    <div class="nd-field" style="margin-bottom:0.85rem;">
                        <label>Label / Nickname <span style="font-weight:400;color:var(--nd-faint);">(optional)</span></label>
                        <input type="text" wire:model.defer="pmLabel" placeholder="e.g. My Salary Account, Airtel Money">
                        @error('pmLabel') <div class="err">{{ $message }}</div> @enderror
                    </div>

                    @if($pmType === 'bank')
                        {{-- Bank Fields --}}
                        <div class="nd-field" style="margin-bottom:0.85rem;">
                            <label>Bank Name <span class="req">*</span></label>
                            <input type="text" wire:model.defer="pmBankName" placeholder="e.g. Zanaco, FNB, Stanbic">
                            @error('pmBankName') <div class="err">{{ $message }}</div> @enderror
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                            <div class="nd-field" style="margin-bottom:0.85rem;">
                                <label>Account Name <span class="req">*</span></label>
                                <input type="text" wire:model.defer="pmAccountName" placeholder="John Banda">
                                @error('pmAccountName') <div class="err">{{ $message }}</div> @enderror
                            </div>
                            <div class="nd-field" style="margin-bottom:0.85rem;">
                                <label>Account Number <span class="req">*</span></label>
                                <input type="text" wire:model.defer="pmAccountNumber" placeholder="0123456789">
                                @error('pmAccountNumber') <div class="err">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                            <div class="nd-field" style="margin-bottom:0.85rem;">
                                <label>Branch Name</label>
                                <input type="text" wire:model.defer="pmBranchName" placeholder="e.g. Cairo Road Branch">
                                @error('pmBranchName') <div class="err">{{ $message }}</div> @enderror
                            </div>
                            <div class="nd-field" style="margin-bottom:0.85rem;">
                                <label>SWIFT Code</label>
                                <input type="text" wire:model.defer="pmSwiftCode" placeholder="e.g.ABORZMLU">
                                @error('pmSwiftCode') <div class="err">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    @else
                        {{-- Mobile Money Fields --}}
                        <div class="nd-field" style="margin-bottom:0.85rem;">
                            <label>Provider <span class="req">*</span></label>
                            <select wire:model.defer="pmProvider">
                                <option value="">Select provider</option>
                                <option value="Airtel Money">Airtel Money</option>
                                <option value="MTN MoMo">MTN Mobile Money</option>
                                <option value="Zamtel Kwacha">Zamtel Kwacha</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('pmProvider') <div class="err">{{ $message }}</div> @enderror
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                            <div class="nd-field" style="margin-bottom:0.85rem;">
                                <label>Mobile Number <span class="req">*</span></label>
                                <input type="text" wire:model.defer="pmMobileNumber" placeholder="e.g. 0977 123 456">
                                @error('pmMobileNumber') <div class="err">{{ $message }}</div> @enderror
                            </div>
                            <div class="nd-field" style="margin-bottom:0.85rem;">
                                <label>Registered Name <span class="req">*</span></label>
                                <input type="text" wire:model.defer="pmRegisteredName" placeholder="John Banda">
                                @error('pmRegisteredName') <div class="err">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    @endif

                    {{-- Currency + Primary --}}
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;align-items:end;">
                        <div class="nd-field" style="margin-bottom:0.85rem;">
                            <label>Currency</label>
                            <select wire:model.defer="pmCurrency">
                                <option value="ZMW">ZMW (Kwacha)</option>
                                <option value="USD">USD (US Dollar)</option>
                                <option value="EUR">EUR (Euro)</option>
                                <option value="GBP">GBP (Pound)</option>
                                <option value="ZAR">ZAR (Rand)</option>
                            </select>
                        </div>
                        <div class="nd-field" style="margin-bottom:0.85rem;">
                            <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;">
                                <input type="checkbox" wire:model.defer="pmIsPrimary" style="width:auto;cursor:pointer;">
                                <span style="text-transform:none;font-size:0.82rem;">Set as primary</span>
                            </label>
                        </div>
                    </div>

                    <div style="display:flex;gap:0.5rem;margin-top:0.5rem;">
                        <button wire:click="savePaymentMethod" class="nd-btn nd-btn-amber" style="flex:1;justify-content:center;">
                            <i class="fas fa-check"></i> {{ $editingPaymentId ? 'Update' : 'Add' }} Method
                        </button>
                        <button wire:click="closePaymentModal" class="nd-btn nd-btn-ghost">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- â•â•â•â•â•â•â•â•â•â•â• Password Modal â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($showPasswordModal)
        <div class="nd-overlay" wire:click.self="closePasswordModal">
            <div class="nd-modal">
                <div class="nd-modal-head">
                    <h4><i class="fas fa-lock mr-2"></i> Change Password</h4>
                    <button wire:click="closePasswordModal" style="background:none;border:none;color:rgba(255,255,255,0.7);cursor:pointer;font-size:1rem;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="nd-modal-body">
                    <div class="nd-field" style="margin-bottom:0.85rem;">
                        <label>Current Password</label>
                        <input type="password" wire:model.defer="currentPassword" placeholder="Enter current password">
                        @error('currentPassword') <div class="err">{{ $message }}</div> @enderror
                    </div>
                    <div class="nd-field" style="margin-bottom:0.85rem;">
                        <label>New Password</label>
                        <input type="password" wire:model.defer="newPassword" placeholder="Min 8 characters">
                        @error('newPassword') <div class="err">{{ $message }}</div> @enderror
                    </div>
                    <div class="nd-field" style="margin-bottom:0.85rem;">
                        <label>Confirm New Password</label>
                        <input type="password" wire:model.defer="newPasswordConfirmation" placeholder="Re-enter new password">
                        @error('newPasswordConfirmation') <div class="err">{{ $message }}</div> @enderror
                    </div>
                    <div style="display:flex;gap:0.5rem;margin-top:1rem;">
                        <button wire:click="changePassword" class="nd-btn nd-btn-amber" style="flex:1;justify-content:center;">
                            <i class="fas fa-check"></i> Update Password
                        </button>
                        <button wire:click="closePasswordModal" class="nd-btn nd-btn-ghost">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- â•â•â•â•â•â•â•â•â•â•â• Loading Overlay â•â•â•â•â•â•â•â•â•â•â• --}}
    <div wire:loading.flex wire:target="saveProfile,saveAvatar,changePassword,removeAvatar,savePaymentMethod,deletePaymentMethod,setPrimaryPayment,togglePaymentStatus,saveNrcPhoto,removeNrcPhoto,savePassportPhoto,removePassportPhoto" class="nd-loading">
        <div style="background:#fff;padding:0.85rem 1.75rem;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.1);display:flex;align-items:center;gap:0.65rem;">
            <div class="nd-spinner"></div>
            <span style="font-weight:600;color:var(--nd-text);font-size:0.85rem;">Processing...</span>
        </div>
    </div>
</div>
