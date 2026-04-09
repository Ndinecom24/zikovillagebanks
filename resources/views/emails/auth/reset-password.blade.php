<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        /* Reset */
        body, table, td, p, a { -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; }
        body { margin:0; padding:0; width:100%!important; font-family:'Segoe UI',Arial,Helvetica,sans-serif; line-height:1.6; color:#333; background:#f0f2f5; }
        img { border:0; outline:none; text-decoration:none; }
        table { border-collapse:collapse; mso-table-lspace:0; mso-table-rspace:0; }

        .wrapper { width:100%; background:#f0f2f5; padding:40px 0; }
        .container { max-width:520px; margin:0 auto; background:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,.06); }

        /* Header */
        .header {
            background:linear-gradient(135deg,#1E3A5F 0%,#2B6B96 100%);
            padding:36px 40px 32px; text-align:center;
        }
        .header-icon {
            width:56px; height:56px; border-radius:50%; background:rgba(255,255,255,.15);
            display:inline-flex; align-items:center; justify-content:center; margin-bottom:14px;
        }
        .header h1 { color:#ffffff; font-size:22px; font-weight:800; margin:0 0 4px; letter-spacing:-.3px; }
        .header p { color:rgba(255,255,255,.6); font-size:13px; margin:0; font-weight:500; }

        /* Body */
        .email-body { padding:36px 40px 28px; }
        .greeting { font-size:16px; font-weight:700; color:#1E3A5F; margin:0 0 14px; }
        .email-body p { font-size:14px; color:#4a5568; margin:0 0 16px; line-height:1.65; }

        /* CTA Button */
        .cta-wrap { text-align:center; margin:28px 0; }
        .cta-btn {
            display:inline-block; padding:14px 40px; background:linear-gradient(135deg,#D97706,#F59E0B);
            color:#ffffff!important; font-size:15px; font-weight:700; text-decoration:none;
            border-radius:12px; letter-spacing:.2px;
            box-shadow:0 4px 14px rgba(217,119,6,.3);
        }

        /* Info box */
        .info-box {
            background:#f7f9fc; border:1px solid #e8ecf1; border-radius:10px;
            padding:16px 20px; margin:20px 0; font-size:13px; color:#64748b;
        }
        .info-box i { margin-right:6px; }
        .info-box strong { color:#1E3A5F; }

        /* URL fallback */
        .url-fallback { font-size:12px; color:#94a3b8; word-break:break-all; margin:16px 0 0; line-height:1.5; }
        .url-fallback a { color:#2B6B96; text-decoration:underline; }

        /* Divider */
        .divider { border:none; border-top:1px solid #e8ecf1; margin:24px 0; }

        /* Footer */
        .footer { padding:20px 40px 28px; text-align:center; background:#fafbfc; border-top:1px solid #f0f2f5; }
        .footer p { font-size:12px; color:#94a3b8; margin:0 0 4px; }
        .footer a { color:#2B6B96; text-decoration:none; }

        /* Responsive */
        @media only screen and (max-width:600px) {
            .wrapper { padding:20px 12px!important; }
            .container { border-radius:12px; }
            .header { padding:28px 24px 24px; }
            .header h1 { font-size:19px; }
            .email-body { padding:28px 24px 20px; }
            .footer { padding:16px 24px 20px; }
            .cta-btn { padding:12px 32px; font-size:14px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            {{-- Header --}}
            <div class="header">
                <div class="header-icon">
                    <span style="font-size:26px;">🔐</span>
                </div>
                <h1>Password Reset</h1>
                <p>Village Banking Platform</p>
            </div>

            {{-- Body --}}
            <div class="email-body">
                <p class="greeting">Hi {{ $userName }},</p>

                <p>
                    We received a request to reset the password for your account.
                    Click the button below to choose a new password:
                </p>

                <div class="cta-wrap">
                    <a href="{{ $url }}" class="cta-btn">Reset My Password</a>
                </div>

                <div class="info-box">
                    ⏱ This link will expire in <strong>{{ $expireMinutes }} minutes</strong>.<br>
                    🔒 If you didn't request a password reset, you can safely ignore this email —
                    your account is still secure.
                </div>

                <hr class="divider">

                <p class="url-fallback">
                    <strong>Can't click the button?</strong> Copy and paste this URL into your browser:<br>
                    <a href="{{ $url }}">{{ $url }}</a>
                </p>
            </div>

            {{-- Footer --}}
            <div class="footer">
                <p>&copy; {{ date('Y') }} Village Banking Platform. All rights reserved.</p>
                <p>This is an automated message — please do not reply directly.</p>
            </div>
        </div>
    </div>
</body>
</html>
