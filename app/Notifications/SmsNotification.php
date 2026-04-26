<?php

namespace App\Notifications;

use App\Notifications\Channels\SmsChannel;
use App\Notifications\Channels\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

/**
 * Example notification that sends an SMS via the MTN SMS Gateway.
 *
 * Usage:
 *     $user->notify(new SmsNotification('Your OTP is 1234'));
 */
class SmsNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected string $smsBody,
        protected ?string $recipient = null,
    ) {}

    /**
     * Delivery channels.
     */
    public function via(object $notifiable): array
    {
        return [SmsChannel::class];
    }

    /**
     * Build the SMS message.
     */
    public function toMtnSms(object $notifiable): SmsMessage
    {
        $msg = (new SmsMessage)->content($this->smsBody);

        if ($this->recipient) {
            $msg->to($this->recipient);
        }

        return $msg;
    }

    /**
     * Array representation (for database channel, if needed later).
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message'   => $this->smsBody,
            'recipient' => $this->recipient,
        ];
    }
}
