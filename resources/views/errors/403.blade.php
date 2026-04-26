<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 — Access Denied | {{ config('app.name') }}</title>
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Segoe UI',system-ui,-apple-system,sans-serif;background:#f4f6fa;display:flex;align-items:center;justify-content:center;min-height:100vh;color:#1e293b}
        .card{text-align:center;background:#fff;border-radius:20px;padding:3rem 2.5rem;box-shadow:0 8px 30px rgba(0,0,0,.08);max-width:440px;width:90%}
        .code{font-size:5rem;font-weight:800;color:#991b1b;line-height:1;margin-bottom:.5rem}
        .title{font-size:1.25rem;font-weight:700;color:#1E3A5F;margin-bottom:.5rem}
        .desc{font-size:.9rem;color:#64748b;margin-bottom:1.5rem;line-height:1.5}
        .btn{display:inline-block;padding:.65rem 1.5rem;background:linear-gradient(135deg,#1E3A5F,#2B6B96);color:#fff;text-decoration:none;border-radius:10px;font-weight:600;font-size:.88rem;transition:transform .15s}
        .btn:hover{transform:translateY(-2px)}
        .icon{font-size:3rem;margin-bottom:1rem;opacity:.2}
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">🔒</div>
        <div class="code">403</div>
        <div class="title">Access Denied</div>
        <p class="desc">You don't have permission to access this resource. Contact your administrator if you believe this is an error.</p>
        <a href="{{ url('/') }}" class="btn">← Back to Home</a>
    </div>
</body>
</html>
