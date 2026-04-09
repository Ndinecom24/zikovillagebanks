<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Village Banking Platform')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @livewireStyles

    <style>
        :root {
            --nd-primary: #1E3A5F;
            --nd-primary-dark: #152C47;
            --nd-primary-light: #2B6B96;
            --nd-accent: #D97706;
            --nd-accent-light: #F59E0B;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #1a2332;
            background: #ffffff;
            -webkit-font-smoothing: antialiased;
        }
        /* ===== Navbar ===== */
        .landing-nav {
            position: fixed; top:0; left:0; right:0; z-index:100;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem 0;
        }
        .landing-nav .container {
            max-width: 1200px; margin:0 auto; padding:0 1.5rem;
            display:flex; align-items:center; justify-content:space-between;
        }
        .landing-nav .logo {
            font-size:1.3rem; font-weight:800; color:var(--nd-primary); text-decoration:none;
        }
        .landing-nav .logo span { color:var(--nd-accent); }
        .landing-nav .nav-links { display:flex; gap:1.5rem; align-items:center; }
        .landing-nav .nav-links a { text-decoration:none; color:#475569; font-weight:500; font-size:0.92rem; transition:color 0.2s; }
        .landing-nav .nav-links a:hover { color:var(--nd-primary); }
        .btn-nav-login {
            background:var(--nd-primary); color:#fff!important; padding:0.5rem 1.25rem; border-radius:8px;
            font-weight:600; font-size:0.88rem; text-decoration:none; transition:background 0.2s;
        }
        .btn-nav-login:hover { background:var(--nd-primary-dark); }
        .btn-nav-register {
            background:transparent; color:var(--nd-primary)!important; padding:0.45rem 1.15rem; border-radius:8px;
            font-weight:600; font-size:0.88rem; text-decoration:none; border:2px solid var(--nd-primary); transition:all 0.2s;
        }
        .btn-nav-register:hover { background:var(--nd-primary); color:#fff!important; }
        /* ===== Hero ===== */
        .hero {
            padding: 7rem 1.5rem 3rem;
            background: linear-gradient(160deg, #f8fafc 0%, #fff 40%, #fffbeb 100%);
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -40%; right: -20%;
            width: 700px; height: 700px;
            background: radial-gradient(circle, rgba(30,58,95,0.04) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%; left: -15%;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(217,119,6,0.05) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero .container {
            max-width: 1200px; margin: 0 auto; padding: 0 1.5rem;
            display: flex; align-items: center; gap: 3.5rem; position: relative; z-index: 1;
        }
        .hero-text { flex: 1; min-width: 320px; text-align: left; }
        .hero-visual { flex: 1; min-width: 320px; position: relative; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.5rem;
            background: rgba(30,58,95,0.08); color: var(--nd-primary);
            padding: 0.4rem 1rem; border-radius: 20px;
            font-size: 0.82rem; font-weight: 600; margin-bottom: 1.25rem;
            letter-spacing: 0.3px;
        }
        .hero-badge i { color: var(--nd-accent); }
        .hero h1 {
            font-size: 3rem; font-weight: 800; line-height: 1.12;
            margin-bottom: 1.25rem; color: #0f172a; letter-spacing: -0.5px;
        }
        .hero h1 span {
            background: linear-gradient(135deg, var(--nd-primary), var(--nd-primary-light));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            font-size: 1.1rem; color: #475569; max-width: 520px;
            line-height: 1.7; margin-bottom: 2rem;
        }
        .hero .cta-row { display: flex; gap: 0.85rem; flex-wrap: wrap; }
        .btn-hero-primary {
            background: linear-gradient(135deg, var(--nd-accent), #B45309); color: #fff;
            padding: 0.9rem 2rem; border-radius: 12px;
            font-weight: 700; font-size: 1rem; border: none; cursor: pointer;
            text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(217,119,6,0.3);
            transition: all 0.3s ease;
        }
        .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(217,119,6,0.35); }
        .btn-hero-secondary {
            background: #fff; color: var(--nd-primary); padding: 0.9rem 2rem; border-radius: 12px;
            font-weight: 700; font-size: 1rem; border: 2px solid #e2e8f0; cursor: pointer;
            text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn-hero-secondary:hover { border-color: var(--nd-primary); background: #f8fafc; }
        .hero-trust {
            display: flex; align-items: center; gap: 1rem; margin-top: 2rem;
            padding-top: 1.5rem; border-top: 1px solid #e2e8f0;
        }
        .hero-trust-avatars {
            display: flex;
        }
        .hero-trust-avatars span {
            width: 36px; height: 36px; border-radius: 50%; border: 2px solid #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700; color: #fff; margin-left: -8px;
        }
        .hero-trust-avatars span:first-child { margin-left: 0; }
        .hero-trust-text { font-size: 0.85rem; color: #64748b; line-height: 1.4; }
        .hero-trust-text strong { color: #0f172a; }
        /* Hero images */
        .hero-img-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;
            animation: heroFloat 6s ease-in-out infinite;
        }
        @keyframes heroFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .hero-img-card {
            border-radius: 16px; overflow: hidden; position: relative;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        .hero-img-card:hover { transform: scale(1.02); }
        .hero-img-card img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .hero-img-card.tall { grid-row: span 2; }
        .hero-stat-float {
            position: absolute; background: #fff; border-radius: 14px;
            padding: 0.75rem 1rem; box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            display: flex; align-items: center; gap: 0.6rem; z-index: 5;
            animation: statPulse 4s ease-in-out infinite;
        }
        @keyframes statPulse {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-4px) scale(1.02); }
        }
        .hero-stat-float .stat-icon {
            width: 38px; height: 38px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem;
        }
        .hero-stat-float .stat-value { font-size: 1.1rem; font-weight: 800; color: #0f172a; line-height: 1.2; }
        .hero-stat-float .stat-label { font-size: 0.72rem; color: #64748b; font-weight: 500; }
        @media (max-width: 900px) {
            .hero .container { flex-direction: column; text-align: center; }
            .hero-text { text-align: center; }
            .hero p { margin-left: auto; margin-right: auto; }
            .hero .cta-row { justify-content: center; }
            .hero-trust { justify-content: center; }
            .hero h1 { font-size: 2.2rem; }
            .hero-stat-float { display: none; }
        }
        /* ===== Features ===== */
        .features { padding:4rem 1.5rem; background:#fff; }
        .features .container { max-width:1100px; margin:0 auto; }
        .features h2 { text-align:center; font-size:2rem; font-weight:700; margin-bottom:0.5rem; }
        .features .subtitle { text-align:center; color:#64748b; font-size:1rem; margin-bottom:3rem; }
        .feature-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(280px,1fr)); gap:1.5rem; }
        .feature-card {
            background:#f8fafc; border-radius:14px; padding:1.75rem; border:1px solid #e2e8f0;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .feature-card:hover { transform:translateY(-3px); box-shadow:0 8px 25px rgba(0,0,0,0.06); border-color: var(--nd-accent-light); }
        .feature-icon {
            width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center;
            font-size:1.2rem; margin-bottom:1rem;
        }
        .feature-card h3 { font-size:1.05rem; font-weight:700; margin-bottom:0.5rem; }
        .feature-card p { font-size:0.9rem; color:#64748b; line-height:1.6; }
        /* ===== Pricing ===== */
        .pricing { padding:4rem 1.5rem; background:#f8fafc; }
        .pricing .container { max-width:1100px; margin:0 auto; }
        .pricing h2 { text-align:center; font-size:2rem; font-weight:700; margin-bottom:0.5rem; }
        .pricing .subtitle { text-align:center; color:#64748b; font-size:1rem; margin-bottom:3rem; }
        .pricing-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(300px,1fr)); gap:1.5rem; }
        .plan-card {
            background:#fff; border-radius:16px; padding:2rem; border:2px solid #e2e8f0;
            position:relative; transition:transform 0.2s, box-shadow 0.2s;
        }
        .plan-card.featured { border-color:var(--nd-accent); box-shadow:0 8px 30px rgba(217,119,6,0.12); }
        .plan-card.featured::before {
            content:'Most Popular'; position:absolute; top:-12px; left:50%; transform:translateX(-50%);
            background: linear-gradient(135deg, var(--nd-accent), #B45309); color:#fff; font-size:0.75rem; font-weight:700;
            padding:4px 16px; border-radius:20px; text-transform:uppercase; letter-spacing:0.5px;
        }
        .plan-card:hover { transform:translateY(-3px); }
        .plan-name { font-size:1.2rem; font-weight:700; margin-bottom:0.25rem; }
        .plan-price { font-size:2.5rem; font-weight:800; color:var(--nd-primary); margin:0.75rem 0; }
        .plan-price span { font-size:1rem; font-weight:500; color:#64748b; }
        .plan-features { list-style:none; padding:0; margin:1.25rem 0; }
        .plan-features li { padding:0.4rem 0; font-size:0.9rem; color:#475569; display:flex; align-items:center; gap:0.5rem; }
        .plan-features li i { color:var(--nd-accent); font-size:0.85rem; }
        .btn-plan {
            display:block; width:100%; text-align:center; padding:0.75rem; border-radius:10px;
            font-weight:700; font-size:0.95rem; border:none; cursor:pointer; transition:all 0.2s;
        }
        .btn-plan-primary { background:var(--nd-primary); color:#fff; }
        .btn-plan-primary:hover { background:var(--nd-primary-dark); }
        .btn-plan-outline { background:#fff; color:var(--nd-primary); border:2px solid var(--nd-primary); }
        .btn-plan-outline:hover { background:#eef2f7; }
        /* ===== How It Works ===== */
        .how-it-works { padding:4rem 1.5rem; background:#fff; }
        .how-it-works .container { max-width:900px; margin:0 auto; }
        .how-it-works h2 { text-align:center; font-size:2rem; font-weight:700; margin-bottom:3rem; }
        .steps { display:flex; flex-direction:column; gap:2rem; counter-reset: step-counter; }
        .step { display:flex; gap:1.25rem; align-items:flex-start; }
        .step:hover .step-num { transform: scale(1.1); }
        .step-num {
            width:44px; height:44px; min-width:44px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            background: linear-gradient(135deg, var(--nd-accent), #B45309); color:#fff; font-weight:800; font-size:1.1rem;
            box-shadow: 0 4px 12px rgba(217,119,6,0.3);
        }
        .step h3 { font-size:1.05rem; font-weight:700; margin-bottom:0.25rem; }
        .step p { font-size:0.9rem; color:#64748b; line-height:1.6; }
        /* ===== Training ===== */
        .training { padding:4rem 1.5rem; background:#f8fafc; }
        .training .container { max-width:1100px; margin:0 auto; }
        .training h2 { text-align:center; font-size:2rem; font-weight:700; margin-bottom:0.5rem; }
        .training .subtitle { text-align:center; color:#64748b; font-size:1rem; margin-bottom:3rem; }
        .training-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(320px,1fr)); gap:1.5rem; }
        .training-card {
            background:#fff; border-radius:16px; overflow:hidden; border:1px solid #e2e8f0;
            transition: transform 0.2s, box-shadow 0.2s; display:flex; flex-direction:column;
        }
        .training-card:hover { transform:translateY(-3px); box-shadow:0 8px 25px rgba(0,0,0,0.08); }
        .training-card-img {
            height:160px; background:linear-gradient(135deg, var(--nd-primary), var(--nd-primary-light));
            display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden;
        }
        .training-card-img img { width:100%; height:100%; object-fit:cover; }
        .training-card-img .tc-icon { font-size:3rem; color:rgba(255,255,255,0.3); }
        .training-card-badge {
            position:absolute; top:12px; left:12px; font-size:0.72rem; font-weight:700;
            padding:4px 12px; border-radius:20px; color:#fff; text-transform:uppercase; letter-spacing:0.5px;
        }
        .training-card-featured {
            position:absolute; top:12px; right:12px; background:var(--nd-accent);
            color:#fff; font-size:0.68rem; font-weight:700; padding:3px 10px; border-radius:20px;
        }
        .training-card-body { padding:1.25rem; flex:1; display:flex; flex-direction:column; }
        .training-card-body h3 { font-size:1.05rem; font-weight:700; margin-bottom:0.5rem; line-height:1.4; }
        .training-card-body .tc-desc { font-size:0.88rem; color:#64748b; line-height:1.6; margin-bottom:1rem; flex:1; }
        .training-card-meta { display:flex; flex-wrap:wrap; gap:0.75rem; margin-bottom:1rem; font-size:0.82rem; color:#64748b; }
        .training-card-meta span { display:flex; align-items:center; gap:0.35rem; }
        .training-card-meta i { color:var(--nd-accent); font-size:0.78rem; }
        .training-card-footer { display:flex; align-items:center; justify-content:space-between; }
        .tc-price { font-size:1.25rem; font-weight:800; color:var(--nd-primary); }
        .tc-price.free { color:#16a34a; }
        .btn-training-apply {
            background:var(--nd-primary); color:#fff; padding:0.5rem 1.25rem; border-radius:8px;
            font-weight:600; font-size:0.88rem; border:none; cursor:pointer; transition:background 0.2s;
        }
        .btn-training-apply:hover { background:var(--nd-primary-dark); }
        .btn-training-apply:disabled { opacity:0.5; cursor:not-allowed; }
        /* ===== Footer ===== */
        .landing-footer {
            background:#0f172a; padding:2.5rem 1.5rem; text-align:center; color:#94a3b8; font-size:0.88rem;
        }
        .landing-footer a { color:var(--nd-accent); text-decoration:none; }
        /* ===== Modal ===== */
        .landing-modal-overlay {
            position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:200;
            display:flex; align-items:center; justify-content:center;
            padding:1rem; overflow-y:auto;
        }
        .landing-modal {
            background:#fff; border-radius:16px; max-width:680px; width:100%;
            max-height:90vh; overflow-y:auto; padding:0;
        }
        .landing-modal-header {
            background: linear-gradient(135deg, var(--nd-accent), #B45309); color:#fff; padding:1.25rem 1.5rem;
            border-radius:16px 16px 0 0; display:flex; align-items:center; justify-content:space-between;
        }
        .landing-modal-header h3 { font-size:1.1rem; font-weight:700; margin:0; }
        .landing-modal-header button {
            background:none; border:none; color:#fff; font-size:1.5rem; cursor:pointer; line-height:1;
        }
        .landing-modal-body { padding:1.5rem; }
        .lf-label { font-size:0.85rem; font-weight:600; color:#334155; margin-bottom:0.35rem; display:block; }
        .lf-input {
            width:100%; padding:0.6rem 0.75rem; border:1.5px solid #e2e8f0; border-radius:8px;
            font-size:0.9rem; font-family:inherit; transition:border-color 0.2s; outline:none;
        }
        .lf-input:focus { border-color:var(--nd-accent); }
        .lf-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem; }
        .lf-col { margin-bottom:1rem; }
        .lf-error { color:#dc3545; font-size:0.8rem; margin-top:0.25rem; }
        .btn-submit-app {
            background:var(--nd-primary); color:#fff; padding:0.75rem 2rem; border-radius:10px;
            font-weight:700; font-size:0.95rem; border:none; cursor:pointer; width:100%; transition:background 0.2s;
        }
        .btn-submit-app:hover { background:var(--nd-primary-dark); }
        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .hero h1 { font-size:2rem; }
            .plan-price { font-size:2rem; }
            .lf-row { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>
    {{ $slot }}

    @livewireScripts
</body>
</html>
