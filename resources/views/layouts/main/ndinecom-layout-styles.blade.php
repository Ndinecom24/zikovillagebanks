{{-- ===== Ndinecom Modern Layout Styles ===== --}}
<style>
/* ====================================================================
   NDINECOM DESIGN TOKENS
   ==================================================================== */
:root {
    /* Primary - Sapphire Navy (brand) */
    --nd-primary: #1E3A5F;
    --nd-primary-dark: #152d4a;
    --nd-primary-darker: #0f2035;
    --nd-primary-light: #2B6B96;

    /* Accent - Warm Amber (highlights, active states) */
    --nd-accent: #D97706;
    --nd-accent-dark: #B45309;
    --nd-accent-light: #F59E0B;

    /* Sidebar background (deep navy) */
    --nd-sidebar-bg: #0f1a2e;
    --nd-sidebar-hover: rgba(217,119,6,0.10);
    --nd-sidebar-active: rgba(217,119,6,0.16);

    /* Text & Surface */
    --nd-text-muted: #94a3b8;
    --nd-surface: #ffffff;
    --nd-border-light: #e2e8f0;
}

/* ====================================================================
   SIDEBAR
   ==================================================================== */
.nd-sidebar {
    background: linear-gradient(180deg, #0f1a2e 0%, #132240 40%, #0b1526 100%) !important;
    border-right: none !important;
    box-shadow: 2px 0 24px rgba(0,0,0,0.22) !important;
}

/* Brand link */
.nd-brand-link {
    background: linear-gradient(135deg, var(--nd-primary) 0%, var(--nd-primary-light) 100%) !important;
    border-bottom: 2px solid var(--nd-accent) !important;
    padding: 0.85rem 1rem !important;
    display: flex !important;
    align-items: center !important;
    transition: all 0.3s ease !important;
}
.nd-brand-link:hover {
    background: linear-gradient(135deg, var(--nd-primary-light) 0%, var(--nd-primary) 100%) !important;
}
.nd-brand-link .brand-image {
    max-height: 34px;
    margin-right: 10px;
    margin-top: 0 !important;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.25));
}
.nd-brand-link .brand-text {
    color: #fff !important;
    font-weight: 700 !important;
    font-size: 1.1rem;
    letter-spacing: 0.03em;
}

/* Sidebar user panel */
.nd-sidebar-user {
    padding: 0.85rem 0.9rem;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    margin-bottom: 0.15rem;
    background: rgba(255,255,255,0.02);
}
.nd-sidebar-avatar {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid rgba(217,119,6,0.35);
    flex-shrink: 0;
    transition: border-color 0.25s;
}
.nd-sidebar-user:hover .nd-sidebar-avatar {
    border-color: var(--nd-accent);
}
.nd-sidebar-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.nd-sidebar-username {
    color: #e2e8f0;
    font-size: 0.82rem;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 140px;
}
.nd-sidebar-role {
    color: #64748b;
    font-size: 0.7rem;
    display: flex;
    align-items: center;
    gap: 0.35rem;
}
.nd-status-dot {
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #34d399;
    box-shadow: 0 0 6px rgba(52, 211, 153, 0.5);
    animation: nd-pulse 2s ease-in-out infinite;
}
@keyframes nd-pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* Section headers */
.nd-nav-header {
    color: var(--nd-accent) !important;
    font-size: 0.65rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.1em !important;
    text-transform: uppercase !important;
    padding: 1rem 1rem 0.35rem !important;
    margin-top: 0.15rem !important;
    position: relative;
}
.nd-nav-header::before {
    content: '';
    position: absolute;
    left: 1rem;
    right: 1rem;
    top: 0.4rem;
    height: 1px;
    background: rgba(255,255,255,0.04);
}

/* Navigation links — top level */
.nd-sidebar .nav-sidebar > .nav-item > .nav-link {
    color: #b0bec5 !important;
    padding: 0.55rem 0.85rem !important;
    margin: 1px 0.6rem !important;
    border-radius: 8px !important;
    font-size: 0.84rem;
    font-weight: 500;
    transition: all 0.2s ease;
    position: relative;
}
.nd-sidebar .nav-sidebar > .nav-item > .nav-link:hover {
    background: var(--nd-sidebar-hover) !important;
    color: #fff !important;
}
.nd-sidebar .nav-sidebar > .nav-item > .nav-link.active {
    background: var(--nd-sidebar-active) !important;
    color: #fff !important;
    font-weight: 600;
    box-shadow: none !important;
}

/* Active indicator bar (amber left line) */
.nd-sidebar .nav-sidebar > .nav-item > .nav-link.active::before {
    content: '';
    position: absolute;
    left: -0.6rem;
    top: 50%;
    transform: translateY(-50%);
    width: 3px;
    height: 22px;
    background: var(--nd-accent);
    border-radius: 0 3px 3px 0;
}

/* Nav icons — top level */
.nd-sidebar .nav-sidebar > .nav-item > .nav-link > .nav-icon {
    color: var(--nd-primary-light) !important;
    font-size: 0.92rem;
    width: 1.6rem !important;
    text-align: center;
    transition: color 0.2s, transform 0.2s;
}
.nd-sidebar .nav-sidebar > .nav-item > .nav-link:hover > .nav-icon,
.nd-sidebar .nav-sidebar > .nav-item > .nav-link.active > .nav-icon {
    color: var(--nd-accent) !important;
    transform: scale(1.08);
}

/* ── Treeview / Collapsible sub-menus ── */
.nd-sidebar .nav-sidebar .has-treeview > .nav-link > p > .right {
    transition: transform 0.25s ease;
}
.nd-sidebar .nav-sidebar .has-treeview.menu-open > .nav-link > p > .fa-angle-left {
    transform: rotate(-90deg);
}

/* Sub-menu container */
.nd-sidebar .nav-treeview {
    background: rgba(0,0,0,0.18) !important;
    border-radius: 0 0 8px 8px;
    margin: 0 0.6rem 0.2rem !important;
    padding: 0.25rem 0 !important;
    overflow: hidden;
}

/* Sub-menu links */
.nd-sidebar .nav-treeview > .nav-item > .nav-link {
    color: #8fa3b0 !important;
    padding: 0.4rem 0.75rem 0.4rem 1rem !important;
    margin: 0 !important;
    border-radius: 6px !important;
    font-size: 0.8rem;
    font-weight: 400;
    transition: all 0.18s ease;
}
.nd-sidebar .nav-treeview > .nav-item > .nav-link:hover {
    color: #e2e8f0 !important;
    background: rgba(43,107,150,0.12) !important;
    padding-left: 1.15rem !important;
}
.nd-sidebar .nav-treeview > .nav-item > .nav-link.active {
    color: #fff !important;
    background: rgba(43,107,150,0.18) !important;
    font-weight: 600;
}
/* Sub-menu bullet icon — smaller + colored on active */
.nd-sidebar .nav-treeview > .nav-item > .nav-link > .nav-icon {
    font-size: 0.45rem !important;
    color: #546e7a !important;
    width: 1.4rem !important;
}
.nd-sidebar .nav-treeview > .nav-item > .nav-link.active > .nav-icon,
.nd-sidebar .nav-treeview > .nav-item > .nav-link:hover > .nav-icon {
    color: var(--nd-accent) !important;
}

/* Treeview badge pill */
.nd-badge {
    font-size: 0.6rem !important;
    padding: 0.15rem 0.45rem !important;
    border-radius: 12px;
    font-weight: 700;
    opacity: 0.75;
}

/* Sidebar scrollbar */
.nd-sidebar .sidebar {
    padding-bottom: 1.5rem;
}
.nd-sidebar .os-scrollbar-handle {
    background: rgba(255,255,255,0.1) !important;
    border-radius: 4px !important;
}
.nd-sidebar .os-scrollbar-handle:hover {
    background: rgba(255,255,255,0.18) !important;
}

/* ====================================================================
   NAVBAR
   ==================================================================== */
.nd-navbar {
    background: #fff !important;
    border-bottom: none !important;
    box-shadow: 0 1px 8px rgba(0,0,0,0.06) !important;
    padding: 0 1rem !important;
    min-height: 56px;
    position: relative;
}
.nd-navbar::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--nd-primary) 0%, var(--nd-accent) 100%);
}

/* Toggle button */
.nd-nav-toggle {
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
.nd-nav-toggle:hover {
    background: rgba(30,58,95,0.07) !important;
    color: var(--nd-primary) !important;
}

/* Breadcrumb link */
.nd-nav-breadcrumb {
    color: #374151 !important;
    font-weight: 600;
    font-size: 0.9rem;
}
.nd-nav-breadcrumb:hover {
    color: var(--nd-primary) !important;
}

/* User dropdown trigger */
.nd-navbar-avatar {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid #e5e7eb;
    position: relative;
    flex-shrink: 0;
    transition: border-color 0.2s;
}
.nd-user-dropdown:hover .nd-navbar-avatar {
    border-color: var(--nd-primary);
}
.nd-navbar-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.nd-avatar-status {
    position: absolute;
    bottom: 1px;
    right: 1px;
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #34d399;
    border: 2px solid #fff;
}
.nd-navbar-username {
    font-size: 0.85rem;
    font-weight: 600;
    color: #1a2332;
}
.nd-navbar-role {
    font-size: 0.72rem;
    color: var(--nd-text-muted);
}

/* User dropdown menu */
.nd-user-menu {
    border: 1px solid #e5e7eb !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 40px rgba(0,0,0,0.12) !important;
    padding: 0 !important;
    overflow: hidden;
    min-width: 260px;
    margin-top: 0.5rem !important;
}
.nd-user-menu-header {
    background: linear-gradient(135deg, var(--nd-primary-darker) 0%, var(--nd-primary) 100%);
    padding: 1rem 1.15rem;
    color: #fff;
}
.nd-menu-avatar {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    overflow: hidden;
    border: 2px solid rgba(255,255,255,0.25);
    flex-shrink: 0;
}
.nd-menu-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.nd-user-menu-header strong {
    font-size: 0.9rem;
}
.nd-user-menu-header small {
    font-size: 0.75rem;
}
.nd-menu-item {
    padding: 0.6rem 1.15rem !important;
    font-size: 0.875rem;
    color: #374151 !important;
    transition: all 0.15s !important;
}
.nd-menu-item:hover {
    background: rgba(30,58,95,0.06) !important;
    color: var(--nd-primary) !important;
}
.nd-menu-logout {
    color: #dc2626 !important;
}
.nd-menu-logout:hover {
    background: rgba(220,38,38,0.06) !important;
    color: #dc2626 !important;
}

/* ====================================================================
   FOOTER
   ==================================================================== */
.nd-footer {
    background: #fff !important;
    border-top: none !important;
    padding: 0.75rem 1.5rem !important;
    font-size: 0.82rem;
    position: relative;
}
.nd-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--nd-primary) 0%, var(--nd-accent) 100%);
}
.nd-footer-brand {
    color: var(--nd-primary);
    font-size: 0.85rem;
    font-weight: 600;
}
.nd-footer-sep {
    color: #d1d5db;
    margin: 0 0.6rem;
}
.nd-footer-text {
    color: #6b7280;
}
.nd-footer-version {
    background: linear-gradient(135deg, var(--nd-primary), var(--nd-primary-dark));
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
.sidebar-collapse .nd-sidebar .nd-sidebar-user {
    display: none;
}
.sidebar-collapse .nd-sidebar .nd-nav-header {
    display: none !important;
}
.sidebar-collapse .nd-sidebar .nav-sidebar > .nav-item > .nav-link.active::before {
    display: none;
}
.sidebar-collapse .nd-sidebar .nav-treeview {
    margin: 0 !important;
    border-radius: 8px !important;
}

/* ====================================================================
   RESPONSIVE
   ==================================================================== */
@media (max-width: 768px) {
    .nd-footer > div {
        flex-direction: column;
        gap: 0.5rem;
        text-align: center;
    }
    .nd-footer-sep {
        display: none;
    }
}
</style>
