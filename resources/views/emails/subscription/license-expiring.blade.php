<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; }
        .header { background: #d97706; color: #fff; padding: 20px 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 22px; }
        .body { padding: 30px; background: #f9f9f9; }
        .info-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        .info-table td { padding: 8px 12px; border-bottom: 1px solid #eee; }
        .info-table td:first-child { font-weight: bold; color: #666; width: 140px; }
        .footer { padding: 20px 30px; text-align: center; font-size: 12px; color: #999; }
        .warning-box { background: #fef3c7; border: 2px solid #f59e0b; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center; }
        .warning-box .days { font-size: 36px; font-weight: bold; color: #d97706; }
        .btn-renew { display: inline-block; background: #1E3A5F; color: #fff; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>⚠️ License Expiring Soon</h1>
    </div>
    <div class="body">
        <p>Dear Village Bank Administrator,</p>
        <p>This is a reminder that your village bank license is expiring soon.</p>

        <div class="warning-box">
            <div class="days">{{ $daysRemaining }}</div>
            <div>days remaining</div>
        </div>

        <h3 style="color:#d97706;">License Details</h3>
        <table class="info-table">
            <tr><td>Village Bank</td><td>{{ $license->villageBank ? $license->villageBank->name : '—' }}</td></tr>
            <tr><td>License Key</td><td>{{ $license->license_key }}</td></tr>
            <tr><td>Expires On</td><td>{{ $license->expires_at ? $license->expires_at->format('d M Y') : '—' }}</td></tr>
            <tr><td>Plan</td><td>{{ $license->subscription && $license->subscription->plan ? $license->subscription->plan->name : '—' }}</td></tr>
        </table>

        <p>To ensure uninterrupted access, please renew your subscription before the expiry date. Log in to the platform and navigate to your subscription settings to submit a renewal payment.</p>

        <p style="text-align:center;">
            <a href="{{ url('/login') }}" class="btn-renew">Renew Now</a>
        </p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Village Banking Platform. All rights reserved.
    </div>
</body>
</html>
