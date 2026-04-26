<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>503 — Maintenance | {{ config('app.name') }}</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Segoe UI',system-ui,-apple-system,sans-serif;background:#f4f6fa;display:flex;align-items:center;justify-content:center;min-height:100vh;color:#1e293b}
        .card{text-align:center;background:#fff;border-radius:20px;padding:3rem 2.5rem;box-shadow:0 8px 30px rgba(0,0,0,.08);max-width:480px;width:90%}
        .code{font-size:5rem;font-weight:800;color:#D97706;line-height:1;margin-bottom:.5rem}
        .title{font-size:1.25rem;font-weight:700;color:#1E3A5F;margin-bottom:.5rem}
        .desc{font-size:.9rem;color:#64748b;margin-bottom:1.5rem;line-height:1.5}
        .icon{font-size:3rem;margin-bottom:1rem;opacity:.25}
        .retry{margin-top:1rem;font-size:.8rem;color:#94a3b8}
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">🔧</div>
        <div class="code">503</div>
        <div class="title">Under Maintenance</div>
        <p class="desc">We're performing scheduled maintenance to improve your experience. We'll be back shortly.</p>
        <p class="retry">This page will auto-refresh in 30 seconds.</p>
    </div>
    <script>setTimeout(function(){ location.reload(); }, 30000);</script>
</body>
</html>
