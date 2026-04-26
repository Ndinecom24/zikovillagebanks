<?php

namespace App\Notifications\Channels;

use App\Services\MtnSmsService;
use Illuminate\Notifications\Notification;

/**
 * Laravel Notification channel that dispatches SMS via the MTN SMS v3 API.
 *
 * In your Notification class:
 *
 *     public function via($notifiable)
 *     {
 *         return ['mail', SmsChannel::class];
 *     }
 *
 *     public function toMtnSms($notifiable): SmsMessage
 *     {
 *         return (new SmsMessage)
 *             ->to($notifiable->mobile_no)
 *             ->content('Hello from Ziko Village Banking!');
 *     }
 */
class SmsChannel
{
    public function __construct(protected MtnSmsService $sms) {}

    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        /** @var SmsMessage $message */
        $message = $notification->toMtnSms($notifiable);

        if (!$message instanceof SmsMessage) {
            return;
        }

        // Determine the recipient: explicit on message → routeNotificationFor → mobile_no
        $recipient = $message->recipient
            ?? $notifiable->routeNotificationFor('mtn_sms', $notification)
            ?? $notifiable->mobile_no
            ?? null;

        if (!$recipient || !$message->content) {
            return;
        }

        $options = [];

        if ($message->senderAddress) {
            $options['senderAddress'] = $message->senderAddress;
        }
        if ($message->serviceCode) {
            $options['serviceCode'] = $message->serviceCode;
        }

        $this->sms->sendOne($recipient, $message->content, $options);
    }
}
