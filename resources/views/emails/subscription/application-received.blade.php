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
        .badge { display: inline-block; background: #D97706; color: #fff; padding: 4px 12px; border-radius: 12px; font-weight: bold; font-size: 13px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Application Received</h1>
    </div>
    <div class="body">
        <p>Dear {{ $application->contact_name }},</p>
        <p>Thank you for applying to the <strong>Village Banking Platform</strong>. We have received your application and it is currently under review.</p>

        <h3 style="color:#1E3A5F;">Application Details</h3>
        <table class="info-table">
            <tr><td>Bank Name</td><td>{{ $application->bank_name }}</td></tr>
            <tr><td>Plan</td><td>{{ $application->plan ? $application->plan->name : '—' }}</td></tr>
            <tr><td>Payment Ref</td><td>{{ $application->payment_reference }}</td></tr>
            <tr><td>Status</td><td><span class="badge">Pending Review</span></td></tr>
        </table>

        <p>Our team will review your payment proof and get back to you within <strong>24 hours</strong>. You will receive an email once your application has been processed.</p>

        <p>Thank you for choosing the Village Banking Platform!</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Village Banking Platform. All rights reserved.
    </div>
</body>
</html>
