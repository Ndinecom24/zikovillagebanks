<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; }
        .header { background: #dc3545; color: #fff; padding: 20px 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 22px; }
        .body { padding: 30px; background: #f9f9f9; }
        .info-table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        .info-table td { padding: 8px 12px; border-bottom: 1px solid #eee; }
        .info-table td:first-child { font-weight: bold; color: #666; width: 140px; }
        .footer { padding: 20px 30px; text-align: center; font-size: 12px; color: #999; }
        .remarks-box { background: #fff3cd; border: 1px solid #ffc107; border-radius: 8px; padding: 15px; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Application Not Approved</h1>
    </div>
    <div class="body">
        <p>Dear {{ $application->contact_name }},</p>
        <p>Unfortunately, your village bank application for <strong>{{ $application->bank_name }}</strong> was not approved at this time.</p>

        @if($application->admin_remarks)
            <div class="remarks-box">
                <strong>Reason:</strong>
                <p style="margin-bottom:0;">{{ $application->admin_remarks }}</p>
            </div>
        @endif

        <h3 style="color:#666;">What You Can Do</h3>
        <ul>
            <li>Review the reason above and address any issues</li>
            <li>Resubmit your application with correct payment details</li>
            <li>Contact our support team for assistance</li>
        </ul>

        <p>We apologize for any inconvenience and look forward to processing your next application.</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Village Banking Platform. All rights reserved.
    </div>
</body>
</html>
