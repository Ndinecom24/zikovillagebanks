<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'IPP Management') - {{ config('app.name', 'ZESCO') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --zesco-green: #006B3F;
            --zesco-green-dark: #004D2E;
            --zesco-green-light: #00895A;
            --zesco-gold: #FFB223;
            --zesco-gold-light: #FFC554;
            --surface: #ffffff;
            --surface-hover: #f8fafb;
            --text-primary: #1a2332;
            --text-secondary: #5a6a7e;
            --text-muted: #8896a7;
            --border: #e2e8f0;
            --border-focus: #006B3F;
            --error: #dc3545;
            --error-bg: #fef2f2;
            --success: #10b981;
            --success-bg: #ecfdf5;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -2px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.04);
            --radius: 12px;
            --radius-sm: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f0f4f8;
            min-height: 100vh;
            color: var(--text-primary);
            -webkit-font-smoothing: antialiased;
        }

        .auth-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ===== Left Brand Panel ===== */
        .auth-brand-panel {
            display: none;
            width: 45%;
            max-width: 640px;
            background: linear-gradient(160deg, var(--zesco-green-dark) 0%, var(--zesco-green) 50%, var(--zesco-green-light) 100%);
            position: relative;
            overflow: hidden;
            padding: 3rem;
            flex-direction: column;
            justify-content: space-between;
        }

        .auth-brand-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 80%;
            height: 200%;
            background: radial-gradient(ellipse, rgba(255,255,255,0.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .auth-brand-panel::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -20%;
            width: 60%;
            height: 60%;
            background: radial-gradient(ellipse, rgba(255,178,35,0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .brand-top {
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            width: 140px;
            margin-bottom: 0.5rem;
            filter: brightness(0) invert(1);
        }

        .brand-content {
            position: relative;
            z-index: 1;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-content h1 {
            font-size: 2.25rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .brand-content h1 span {
            color: var(--zesco-gold);
        }

        .brand-content p {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.75);
            line-height: 1.7;
            max-width: 420px;
        }

        .brand-features {
            margin-top: 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .brand-feature {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            color: rgba(255,255,255,0.85);
            font-size: 0.925rem;
        }

        .brand-feature .feature-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1rem;
        }

        .brand-bottom {
            position: relative;
            z-index: 1;
            color: rgba(255,255,255,0.45);
            font-size: 0.8rem;
        }

        /* ===== Right Form Panel ===== */
        .auth-form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            background: #f0f4f8;
            overflow-y: auto;
        }

        .auth-form-container {
            width: 100%;
            max-width: 480px;
        }

        .auth-mobile-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-mobile-logo img {
            height: 56px;
        }

        .auth-card {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: 2.5rem;
            border: 1px solid var(--border);
        }

        .auth-card-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-card-header .auth-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--zesco-green), var(--zesco-green-light));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            color: #fff;
            font-size: 1.35rem;
        }

        .auth-card-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.4rem;
        }

        .auth-card-header p {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        /* ===== Alerts ===== */
        .auth-alert {
            padding: 0.875rem 1rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            display: flex;
            align-items: flex-start;
            gap: 0.625rem;
            line-height: 1.5;
        }

        .auth-alert-danger {
            background: var(--error-bg);
            color: var(--error);
            border: 1px solid #fecaca;
        }

        .auth-alert-success {
            background: var(--success-bg);
            color: var(--success);
            border: 1px solid #a7f3d0;
        }

        .auth-alert .alert-icon {
            font-size: 1.1rem;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .auth-alert ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .auth-alert ul li + li {
            margin-top: 0.25rem;
        }

        /* ===== Form Elements ===== */
        .form-field {
            margin-bottom: 1.25rem;
        }

        .form-field label {
            display: block;
            font-size: 0.825rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.4rem;
            letter-spacing: 0.01em;
        }

        .input-group-auth {
            position: relative;
        }

        .input-group-auth .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1.05rem;
            pointer-events: none;
            transition: color 0.2s;
            z-index: 2;
        }

        .input-group-auth input,
        .input-group-auth select {
            width: 100%;
            padding: 0.725rem 0.875rem 0.725rem 2.75rem;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            font-family: inherit;
            color: var(--text-primary);
            background: var(--surface);
            transition: all 0.2s ease;
            outline: none;
        }

        .input-group-auth input:focus,
        .input-group-auth select:focus {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(0, 107, 63, 0.1);
        }

        .input-group-auth input:focus ~ .input-icon,
        .input-group-auth select:focus ~ .input-icon {
            color: var(--zesco-green);
        }

        .input-group-auth input.is-invalid {
            border-color: var(--error);
        }

        .input-group-auth input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        }

        .input-group-auth .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0;
            font-size: 1.05rem;
            z-index: 2;
        }

        .input-group-auth .toggle-password:hover {
            color: var(--text-secondary);
        }

        .invalid-feedback-auth {
            display: block;
            font-size: 0.8rem;
            color: var(--error);
            margin-top: 0.35rem;
        }

        /* ===== Checkbox ===== */
        .form-check-auth {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check-auth input[type="checkbox"] {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            accent-color: var(--zesco-green);
            cursor: pointer;
        }

        .form-check-auth label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            cursor: pointer;
            margin: 0;
        }

        /* ===== Buttons ===== */
        .btn-auth-primary {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, var(--zesco-green), var(--zesco-green-light));
            color: #ffffff;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.925rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 2px 8px rgba(0, 107, 63, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-auth-primary:hover {
            background: linear-gradient(135deg, var(--zesco-green-dark), var(--zesco-green));
            box-shadow: 0 4px 14px rgba(0, 107, 63, 0.35);
            transform: translateY(-1px);
        }

        .btn-auth-primary:active {
            transform: translateY(0);
        }

        .btn-auth-secondary {
            width: 100%;
            padding: 0.8rem;
            background: var(--surface);
            color: var(--text-primary);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 0.925rem;
            font-weight: 500;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-auth-secondary:hover {
            background: var(--surface-hover);
            border-color: #cbd5e1;
        }

        /* ===== Links ===== */
        .auth-link {
            color: var(--zesco-green);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: color 0.2s;
        }

        .auth-link:hover {
            color: var(--zesco-green-dark);
            text-decoration: underline;
        }

        .auth-form-footer {
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .auth-divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.5rem 0;
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .auth-bottom-text {
            text-align: center;
            margin-top: 1.75rem;
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .auth-bottom-text a {
            color: var(--zesco-green);
            text-decoration: none;
            font-weight: 600;
        }

        .auth-bottom-text a:hover {
            text-decoration: underline;
        }

        /* ===== Responsive ===== */
        @media (min-width: 1024px) {
            .auth-brand-panel {
                display: flex;
            }

            .auth-mobile-logo {
                display: none;
            }

            .auth-form-panel {
                padding: 3rem;
            }
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 1.75rem 1.25rem;
            }

            .auth-form-panel {
                padding: 1.5rem 1rem;
            }
        }

        /* ===== Utility ===== */
        .mt-1 { margin-top: 0.5rem; }
        .mt-2 { margin-top: 1rem; }
        .mt-3 { margin-top: 1.5rem; }
        .mb-0 { margin-bottom: 0; }
        .text-center { text-align: center; }
        .d-none { display: none; }
    </style>

    @yield('styles')
</head>
<body>
    <div class="auth-wrapper">
        {{-- Left Brand Panel --}}
        <div class="auth-brand-panel">
            <div class="brand-top">
                <img src="{{ asset('img/zesco_logo.png') }}" alt="ZESCO" class="brand-logo">
            </div>
            <div class="brand-content">
                <h1>Independent Power<br><span>Producers</span> Application Management</h1>
                <p>Streamline the management and monitoring of independent power producers across Zambia's energy network.</p>
                <div class="brand-features">
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="bi bi-lightning-charge"></i></div>
                        <span>Real-time Independent power producer applications monitoring</span>
                    </div>
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="bi bi-graph-up-arrow"></i></div>
                        <span>Comprehensive analytics & reporting</span>
                    </div>
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                        <span>Secure document management</span>
                    </div>
                </div>
            </div>
            <div class="brand-bottom">
                &copy; {{ date('Y') }} ZESCO Limited. All rights reserved.
            </div>
        </div>

        {{-- Right Form Panel --}}
        <div class="auth-form-panel">
            <div class="auth-form-container">
                <div class="auth-mobile-logo">
                    <img src="{{ asset('img/zesco_logo.png') }}" alt="ZESCO">
                </div>

                @yield('content')

                @hasSection('footer')
                    @yield('footer')
                @endif
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.toggle-password').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var input = this.closest('.input-group-auth').querySelector('input');
                    var icon = this.querySelector('i');
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.replace('bi-eye-slash', 'bi-eye');
                    } else {
                        input.type = 'password';
                        icon.classList.replace('bi-eye', 'bi-eye-slash');
                    }
                });
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
