<?php

namespace App\Notifications;

use App\Models\VillageBanking\VillageBank;
use App\Notifications\Channels\SmsChannel;
use App\Notifications\Channels\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MemberApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected VillageBank $villageBank,
    ) {}

    /**
     * Delivery channels — mail + SMS.
     */
    public function via(object $notifiable): array
    {
        $channels = ['mail'];

        // Only add SMS if the user has a mobile number
        if (!empty($notifiable->mobile_no)) {
            $channels[] = SmsChannel::class;
        }

        return $channels;
    }

    /**
     * Email notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to ' . $this->villageBank->name . ' — Membership Approved')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Great news! Your membership to **' . $this->villageBank->name . '** has been approved.')
            ->line('You can now log in and access the village bank portal, participate in circles, declare shares, and more.')
            ->action('Go to Dashboard', url('/home'))
            ->line('Welcome aboard!');
    }

    /**
     * SMS notification via MTN Gateway.
     */
    public function toMtnSms(object $notifiable): SmsMessage
    {
        return (new SmsMessage)
            ->content(
                'Welcome! Your membership to ' . $this->villageBank->name .
                ' has been approved. Log in at ' . url('/') . ' to get started.'
            );
    }

    public function toArray(object $notifiable): array
    {
        return [
            'village_bank_id'   => $this->villageBank->id,
            'village_bank_name' => $this->villageBank->name,
            'event'             => 'member_approved',
        ];
    }
}
