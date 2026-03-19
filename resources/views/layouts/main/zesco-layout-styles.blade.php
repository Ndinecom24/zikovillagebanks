{{-- ===== ZESCO Modern Layout Styles ===== --}}
<style>
/* ====================================================================
   ZESCO DESIGN TOKENS
   ==================================================================== */
:root {
    --z-green: #14984f;
    --z-green-dark: #0d7a3e;
    --z-green-darker: #004D2E;
    --z-green-light: #00895A;
    --z-gold: #FFB223;
    --z-gold-dark: #e09a00;
    --z-sidebar-bg: #0f1f17;
    --z-sidebar-hover: rgba(20, 152, 79, 0.12);
    --z-sidebar-active: rgba(20, 152, 79, 0.18);
    --z-text-muted: #94a3b8;
}

/* ====================================================================
   SIDEBAR
   ==================================================================== */
.zesco-sidebar {
    background: linear-gradient(180deg, #0f1f17 0%, #112118 40%, #0d1b14 100%) !important;
    border-right: none !important;
    box-shadow: 2px 0 20px rgba(0,0,0,0.15) !important;
}

/* Brand link */
.zesco-brand-link {
    background: linear-gradient(135deg, var(--z-green-darker) 0%, var(--z-green-dark) 100%) !important;
    border-bottom: 2px solid var(--z-gold) !important;
    padding: 0.95rem 1rem !important;
    display: flex !important;
    align-items: center !important;
    transition: all 0.25s ease !important;
}
.zesco-brand-link:hover {
    background: linear-gradient(135deg, var(--z-green-dark) 0%, var(--z-green) 100%) !important;
}
.zesco-brand-link .brand-image {
    max-height: 36px;
    margin-right: 10px;
    margin-top: 0 !important;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}
.zesco-brand-link .brand-text {
    color: #fff !important;
    font-weight: 700 !important;
    font-size: 1.15rem;
    letter-spacing: 0.02em;
}

/* Sidebar user panel */
.zesco-sidebar-user {
    padding: 1rem 1rem 0.85rem;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    margin-bottom: 0.25rem;
}
.zesco-sidebar-avatar {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid rgba(255,178,35,0.4);
    flex-shrink: 0;
}
.zesco-sidebar-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.zesco-sidebar-username {
    color: #e2e8f0;
    font-size: 0.85rem;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 140px;
}
.zesco-sidebar-role {
    color: #64748b;
    font-size: 0.72rem;
}

/* Section headers */
.zesco-nav-header {
    color: var(--z-gold) !important;
    font-size: 0.68rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.08em !important;
    text-transform: uppercase !important;
    padding: 1.1rem 1rem 0.4rem !important;
    margin-top: 0.25rem !important;
    position: relative;
}
.zesco-nav-header::before {
    content: '';
    position: absolute;
    left: 1rem;
    right: 1rem;
    top: 0.5rem;
    height: 1px;
    background: rgba(255,255,255,0.05);
}

/* Navigation links */
.zesco-sidebar .nav-sidebar .nav-link {
    color: #b0bec5 !important;
    padding: 0.6rem 1rem !important;
    margin: 1px 0.65rem !important;
    border-radius: 8px !important;
    font-size: 0.855rem;
    font-weight: 500;
    transition: all 0.2s ease;
    position: relative;
}
.zesco-sidebar .nav-sidebar .nav-link:hover {
    background: var(--z-sidebar-hover) !important;
    color: #fff !important;
}
.zesco-sidebar .nav-sidebar .nav-link.active {
    background: var(--z-sidebar-active) !important;
    color: #fff !important;
    font-weight: 600;
    box-shadow: none !important;
}
.zesco-sidebar .nav-sidebar .nav-link.active::before {
    content: '';
    position: absolute;
    left: -0.65rem;
    top: 50%;
    transform: translateY(-50%);
    width: 3px;
    height: 24px;
    background: var(--z-gold);
    border-radius: 0 3px 3px 0;
}

/* Nav icons */
.zesco-sidebar .nav-sidebar .nav-icon {
    color: var(--z-green) !important;
    font-size: 0.95rem;
    width: 1.8rem !important;
    text-align: center;
    transition: color 0.2s;
}
.zesco-sidebar .nav-sidebar .nav-link:hover .nav-icon,
.zesco-sidebar .nav-sidebar .nav-link.active .nav-icon {
    color: var(--z-gold) !important;
}

/* Sidebar scrollbar */
.zesco-sidebar .sidebar {
    padding-bottom: 1rem;
}
.zesco-sidebar .os-scrollbar-handle {
    background: rgba(255,255,255,0.12) !important;
}

/* ====================================================================
   NAVBAR
   ==================================================================== */
.zesco-navbar {
    background: #fff !important;
    border-bottom: none !important;
    box-shadow: 0 1px 8px rgba(0,0,0,0.06) !important;
    padding: 0 1rem !important;
    min-height: 56px;
    position: relative;
}
.zesco-navbar::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--z-green) 0%, var(--z-gold) 100%);
}

/* Toggle button */
.zesco-nav-toggle {
    width: 40px;
    height: 40px;
    display: flex !important;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    color: #374151 !important;
    transition: all 0.2s;
    margin-right: 0.25rem;
}
.zesco-nav-toggle:hover {
    background: rgba(20,152,79,0.08) !important;
    color: var(--z-green) !important;
}

/* Breadcrumb link */
.zesco-nav-breadcrumb {
    color: #374151 !important;
    font-weight: 600;
    font-size: 0.9rem;
}
.zesco-nav-breadcrumb:hover {
    color: var(--z-green) !important;
}

/* User dropdown trigger */
.zesco-navbar-avatar {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid #e5e7eb;
    position: relative;
    flex-shrink: 0;
    transition: border-color 0.2s;
}
.zesco-user-dropdown:hover .zesco-navbar-avatar {
    border-color: var(--z-green);
}
.zesco-navbar-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.zesco-avatar-status {
    position: absolute;
    bottom: 1px;
    right: 1px;
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #34d399;
    border: 2px solid #fff;
}
.zesco-navbar-username {
    font-size: 0.85rem;
    font-weight: 600;
    color: #1a2332;
}
.zesco-navbar-role {
    font-size: 0.72rem;
    color: var(--z-text-muted);
}

/* User dropdown menu */
.zesco-user-menu {
    border: 1px solid #e5e7eb !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 40px rgba(0,0,0,0.12) !important;
    padding: 0 !important;
    overflow: hidden;
    min-width: 260px;
    margin-top: 0.5rem !important;
}
.zesco-user-menu-header {
    background: linear-gradient(135deg, var(--z-green-darker) 0%, var(--z-green-dark) 100%);
    padding: 1rem 1.15rem;
    color: #fff;
}
.zesco-menu-avatar {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid rgba(255,255,255,0.25);
    flex-shrink: 0;
}
.zesco-menu-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.zesco-user-menu-header strong {
    font-size: 0.9rem;
}
.zesco-user-menu-header small {
    font-size: 0.75rem;
}
.zesco-menu-item {
    padding: 0.6rem 1.15rem !important;
    font-size: 0.875rem;
    color: #374151 !important;
    transition: all 0.15s !important;
}
.zesco-menu-item:hover {
    background: rgba(20,152,79,0.06) !important;
    color: var(--z-green) !important;
}
.zesco-menu-logout {
    color: #dc2626 !important;
}
.zesco-menu-logout:hover {
    background: rgba(220,38,38,0.06) !important;
    color: #dc2626 !important;
}

/* ====================================================================
   FOOTER
   ==================================================================== */
.zesco-footer {
    background: #fff !important;
    border-top: none !important;
    padding: 0.75rem 1.5rem !important;
    font-size: 0.82rem;
    position: relative;
}
.zesco-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--z-green) 0%, var(--z-gold) 100%);
}
.zesco-footer-brand {
    color: var(--z-green-dark);
    font-size: 0.85rem;
    font-weight: 600;
}
.zesco-footer-sep {
    color: #d1d5db;
    margin: 0 0.6rem;
}
.zesco-footer-text {
    color: #6b7280;
}
.zesco-footer-version {
    background: linear-gradient(135deg, var(--z-green), var(--z-green-dark));
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 0.2rem 0.6rem;
    border-radius: 20px;
    letter-spacing: 0.03em;
}

/* ====================================================================
   SIDEBAR COLLAPSED STATE TWEAKS
   ==================================================================== */
.sidebar-collapse .zesco-sidebar .zesco-sidebar-user {
    display: none;
}
.sidebar-collapse .zesco-sidebar .zesco-nav-header {
    display: none !important;
}
.sidebar-collapse .zesco-sidebar .nav-sidebar .nav-link.active::before {
    display: none;
}

/* ====================================================================
   RESPONSIVE
   ==================================================================== */
@media (max-width: 768px) {
    .zesco-footer > div {
        flex-direction: column;
        gap: 0.5rem;
        text-align: center;
    }
    .zesco-footer-sep {
        display: none;
    }
}
</style>
