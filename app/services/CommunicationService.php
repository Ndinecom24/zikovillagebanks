<?php

namespace App\Services;

use App\Models\User;
use App\Models\VillageBanking\Communication;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankConfiguration;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CommunicationService
{
    /**
     * Resolve the allowed communication channels for a village bank.
     *
     * @return array<string>  e.g. ['email'], ['sms'], ['email','sms'], or []
     */
    public static function allowedChannels(int $villageBankId): array
    {
        $config = VillageBankConfiguration::forBank($villageBankId);
        $channel = $config->communication_channel ?? 'email';

        return match ($channel) {
            'email' => ['email'],
            'sms'   => ['sms'],
            'both'  => ['email', 'sms'],
            'none'  => [],
            default => ['email'],
        };
    }

    /**
     * Send a communication to village bank members.
     *
     * @param  int          $villageBankId
     * @param  string       $channel        'email' or 'sms'
     * @param  string       $message        The message body
     * @param  string|null  $subject        Email subject (ignored for SMS)
     * @param  array|null   $recipientIds   Specific user IDs, or null for all members
     * @param  int|null     $sentBy         The sending user ID
     */
    public static function send(
        int     $villageBankId,
        string  $channel,
        string  $message,
        ?string $subject = null,
        ?array  $recipientIds = null,
        ?int    $sentBy = null,
    ): Communication {
        $bank = VillageBank::with('members')->findOrFail($villageBankId);

        // Resolve recipients
        if (!empty($recipientIds)) {
            $recipients = $bank->members()->whereIn('users.id', $recipientIds)->get();
            $recipientType = 'selected';
        } else {
            $recipients = $bank->members;
            $recipientType = 'all';
            $recipientIds = null;
        }

        // Create the communication record
        $comm = Communication::create([
            'village_bank_id'  => $villageBankId,
            'channel'          => $channel,
            'subject'          => $channel === 'email' ? $subject : null,
            'message'          => $message,
            'recipient_type'   => $recipientType,
            'recipient_ids'    => $recipientIds,
            'total_recipients' => $recipients->count(),
            'sent_count'       => 0,
            'failed_count'     => 0,
            'status'           => 'sending',
            'sent_by'          => $sentBy ?? auth()->id(),
            'sent_at'          => now(),
        ]);

        $sentCount   = 0;
        $failedCount = 0;

        foreach ($recipients as $member) {
            try {
                if ($channel === 'email') {
                    static::sendEmail($member, $subject ?? 'Message from ' . $bank->name, $message, $bank);
                    $sentCount++;
                } elseif ($channel === 'sms') {
                    static::sendSms($member, $message);
                    $sentCount++;
                }
            } catch (\Throwable $e) {
                $failedCount++;
                Log::warning("Communication #{$comm->id} failed for user {$member->id}", [
                    'channel' => $channel,
                    'error'   => $e->getMessage(),
                ]);
            }
        }

        $comm->update([
            'sent_count'   => $sentCount,
            'failed_count' => $failedCount,
            'status'       => $failedCount === $recipients->count() ? 'failed' : 'sent',
        ]);

        return $comm;
    }

    /**
     * Send an email to a single user.
     */
    protected static function sendEmail(User $user, string $subject, string $body, VillageBank $bank): void
    {
        if (empty($user->email)) {
            throw new \RuntimeException('User has no email address');
        }

        Mail::html(
            static::buildEmailHtml($user, $body, $bank),
            function ($mail) use ($user, $subject) {
                $mail->to($user->email, $user->name)
                     ->subject($subject);
            }
        );
    }

    /**
     * Send an SMS to a single user via MtnSmsService.
     */
    protected static function sendSms(User $user, string $body): void
    {
        $phone = $user->mobile_no ?? $user->phone;

        if (empty($phone)) {
            throw new \RuntimeException('User has no phone number');
        }

        $sms    = app(MtnSmsService::class);
        $result = $sms->sendOne($phone, $body);

        if (!$result['success']) {
            throw new \RuntimeException($result['statusMessage'] ?? 'SMS send failed');
        }
    }

    /**
     * Build a simple HTML email.
     */
    protected static function buildEmailHtml(User $user, string $body, VillageBank $bank): string
    {
        $appName = config('app.name', 'Village Banking Platform');
        $bodyHtml = nl2br(e($body));

        return <<<HTML
<!DOCTYPE html>
<html>
<head><meta charset="utf-8">
<style>
    body{font-family:Arial,sans-serif;line-height:1.6;color:#333;max-width:600px;margin:0 auto;}
    .header{background:#1E3A5F;color:#fff;padding:20px 30px;text-align:center;}
    .header h1{margin:0;font-size:20px;}
    .body{padding:30px;background:#f9f9f9;}
    .footer{padding:20px 30px;text-align:center;font-size:12px;color:#999;}
</style>
</head>
<body>
    <div class="header"><h1>{$bank->name}</h1></div>
    <div class="body">
        <p>Dear {$user->name},</p>
        <div style="margin:15px 0;">{$bodyHtml}</div>
        <p style="color:#666;font-size:13px;margin-top:25px;">This message was sent from <strong>{$bank->name}</strong> via the {$appName}.</p>
    </div>
    <div class="footer">&copy; {$appName}. All rights reserved.</div>
</body>
</html>
HTML;
    }
}
