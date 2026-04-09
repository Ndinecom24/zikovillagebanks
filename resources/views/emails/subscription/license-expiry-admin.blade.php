<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; }
        .header { background: linear-gradient(135deg, #1E3A5F, #2d5a8e); color: #fff; padding: 20px 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 20px; }
        .header p { margin: 5px 0 0; font-size: 13px; opacity: 0.85; }
        .body { padding: 30px; background: #f9f9f9; }
        .info-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        .info-table td { padding: 10px 12px; border-bottom: 1px solid #eee; font-size: 14px; }
        .info-table td:first-child { font-weight: bold; color: #666; width: 150px; }
        .footer { padding: 20px 30px; text-align: center; font-size: 12px; color: #999; }
        .alert-box { background: #fef3c7; border: 2px solid #f59e0b; border-radius: 8px; padding: 18px; margin: 20px 0; text-align: center; }
        .alert-box .days { font-size: 42px; font-weight: bold; color: #d97706; }
        .alert-box .days-label { font-size: 14px; color: #92400e; margin-top: 2px; }
        .btn-manage { display: inline-block; background: #1E3A5F; color: #fff; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: bold; margin-top: 10px; }
        .status-badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .status-warning { background: #fef3c7; color: #92400e; }
        .status-critical { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🔔 License Expiry Alert</h1>
        <p>Super Admin Notification</p>
    </div>
    <div class="body">
        <p>Dear Administrator,</p>
        <p>A village bank license is approaching its expiry date and requires attention.</p>

        <div class="alert-box">
            <div class="days">{{ $daysRemaining }}</div>
            <div class="days-label">
                @if($daysRemaining <= 3)
                    <span class="status-badge status-critical">CRITICAL — Expires Very Soon</span>
                @elseif($daysRemaining <= 7)
                    <span class="status-badge status-warning">WARNING — Expiring This Week</span>
                @else
                    <span class="status-badge status-warning">NOTICE — Expiring Soon</span>
                @endif
            </div>
        </div>

        <h3 style="color:#1E3A5F; margin-bottom: 5px;">License Details</h3>
        <table class="info-table">
            <tr><td>Village Bank</td><td><strong>{{ $license->villageBank ? $license->villageBank->name : '—' }}</strong></td></tr>
            <tr><td>License Key</td><td><code style="background:#f1f5f9;padding:2px 6px;border-radius:4px;">{{ $license->license_key }}</code></td></tr>
            <tr><td>Status</td><td style="text-transform:capitalize;">{{ $license->status }}</td></tr>
            <tr><td>Issued</td><td>{{ $license->issued_at ? $license->issued_at->format('d M Y') : '—' }}</td></tr>
            <tr><td>Expires On</td><td><strong style="color:#d97706;">{{ $license->expires_at ? $license->expires_at->format('d M Y') : '—' }}</strong></td></tr>
            <tr><td>Plan</td><td>{{ $license->subscription && $license->subscription->plan ? $license->subscription->plan->name . ' (K' . number_format($license->subscription->plan->price, 2) . ')' : '—' }}</td></tr>
        </table>

        @if($license->villageBank)
            <h3 style="color:#1E3A5F; margin-bottom: 5px;">Bank Contact</h3>
            <table class="info-table">
                <tr><td>Email</td><td>{{ $license->villageBank->email ?? '—' }}</td></tr>
                <tr><td>Phone</td><td>{{ $license->villageBank->phone ?? '—' }}</td></tr>
                <tr><td>Address</td><td>{{ $license->villageBank->address ?? '—' }}</td></tr>
            </table>
        @endif

        <p>You can manage this license from the License Management dashboard:</p>

        <p style="text-align:center;">
            <a href="{{ url('/subscription/licenses') }}" class="btn-manage">Manage Licenses</a>
        </p>

        <p style="font-size:13px;color:#666;margin-top:20px;">
            <strong>Note:</strong> The village bank owner has also been notified about this expiry. If they submit a renewal payment, it will appear in your Payment Review queue for confirmation.
        </p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Village Banking Platform — Admin Notification
    </div>
</body>
</html>
