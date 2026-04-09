<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; }
        .header { background: #1E3A5F; color: #fff; padding: 20px 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 22px; }
        .body { padding: 30px; background: #f9f9f9; }
        .info-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        .info-table td { padding: 8px 12px; border-bottom: 1px solid #eee; }
        .info-table td:first-child { font-weight: bold; color: #666; width: 140px; }
        .footer { padding: 20px 30px; text-align: center; font-size: 12px; color: #999; }
        .badge-success { display: inline-block; background: #16a34a; color: #fff; padding: 4px 12px; border-radius: 12px; font-weight: bold; font-size: 13px; }
        .credentials-box { background: #fff; border: 2px solid #1E3A5F; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .credentials-box h3 { color: #1E3A5F; margin-top: 0; }
        .cred-item { background: #f0f9f4; padding: 8px 12px; border-radius: 4px; margin: 5px 0; font-family: monospace; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Application Approved!</h1>
    </div>
    <div class="body">
        <p>Dear {{ $application->contact_name }},</p>
        <p>Great news! Your village bank application has been <span class="badge-success">Approved</span>.</p>

        <h3 style="color:#1E3A5F;">Your Village Bank</h3>
        <table class="info-table">
            <tr><td>Bank Name</td><td>{{ $application->bank_name }}</td></tr>
            <tr><td>Plan</td><td>{{ $application->plan ? $application->plan->name : '—' }}</td></tr>
            <tr><td>License Key</td><td><strong>{{ $licenseKey }}</strong></td></tr>
        </table>

        <div class="credentials-box">
            <h3>🔑 Your Login Credentials</h3>
            <p>Use these details to log in to the platform:</p>
            <div class="cred-item"><strong>Staff No (Username):</strong> {{ $staffNo }}</div>
            <div class="cred-item"><strong>Password:</strong> {{ $defaultPassword }}</div>
            <p style="color:#dc3545;font-size:13px;margin-bottom:0;">
                ⚠️ Please change your password immediately after your first login.
            </p>
        </div>

        @if($application->admin_remarks)
            <p><strong>Admin Remarks:</strong> {{ $application->admin_remarks }}</p>
        @endif

        <p>You can now log in and start managing your village bank. Welcome aboard!</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Village Banking Platform. All rights reserved.
    </div>
</body>
</html>
