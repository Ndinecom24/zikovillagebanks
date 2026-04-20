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
        .info-table td:first-child { font-weight: bold; color: #666; width: 160px; }
        .footer { padding: 20px 30px; text-align: center; font-size: 12px; color: #999; }
        .badge { display: inline-block; background: #D97706; color: #fff; padding: 4px 12px; border-radius: 12px; font-weight: bold; font-size: 13px; }
        .btn { display: inline-block; background: #1E3A5F; color: #fff; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px; margin-top: 15px; }
        .btn:hover { background: #2B6B96; }
        .alert-bar { background: #fef3c7; border-left: 4px solid #D97706; padding: 12px 16px; border-radius: 4px; margin-bottom: 20px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🔔 New Application Received</h1>
    </div>
    <div class="body">
        <div class="alert-bar">
            <strong>Action Required:</strong> A new village bank application has been submitted and is awaiting your review.
        </div>

        <h3 style="color:#1E3A5F; margin-top: 0;">Bank Details</h3>
        <table class="info-table">
            <tr><td>Bank Name</td><td><strong>{{ $application->bank_name }}</strong></td></tr>
            <tr><td>Bank Code</td><td>{{ $application->bank_code ?? '—' }}</td></tr>
            <tr><td>Bank Email</td><td>{{ $application->bank_email }}</td></tr>
            <tr><td>Bank Phone</td><td>{{ $application->bank_phone }}</td></tr>
            @if($application->bank_address)
                <tr><td>Address</td><td>{{ $application->bank_address }}</td></tr>
            @endif
        </table>

        <h3 style="color:#1E3A5F;">Contact Person</h3>
        <table class="info-table">
            <tr><td>Name</td><td><strong>{{ $application->contact_name }}</strong></td></tr>
            <tr><td>Email</td><td>{{ $application->contact_email }}</td></tr>
            <tr><td>Phone</td><td>{{ $application->contact_phone }}</td></tr>
            <tr><td>Member Number</td><td>{{ $application->contact_staff_no ?? '—' }}</td></tr>
        </table>

        <h3 style="color:#1E3A5F;">Subscription & Payment</h3>
        <table class="info-table">
            <tr><td>Plan</td><td>{{ $application->plan ? $application->plan->name : '—' }}</td></tr>
            <tr><td>Payment Reference</td><td>{{ $application->payment_reference }}</td></tr>
            <tr><td>Status</td><td><span class="badge">Pending Review</span></td></tr>
            <tr><td>Submitted</td><td>{{ $application->created_at->format('d M Y, H:i') }}</td></tr>
        </table>

        <p style="text-align:center;">
            <a href="{{ route('subscription.applications') }}" class="btn">Review Applications</a>
        </p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Village Banking Platform. All rights reserved.
    </div>
</body>
</html>
