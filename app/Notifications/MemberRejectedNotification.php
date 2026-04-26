<?php

namespace App\Notifications;

use App\Models\VillageBanking\VillageBank;
use App\Notifications\Channels\SmsChannel;
use App\Notifications\Channels\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MemberRejectedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected VillageBank $villageBank,
        protected ?string $reason = null,
    ) {}

    /**
     * Delivery channels — mail + SMS.
     */
    public function via(object $notifiable): array
    {
        $channels = ['mail'];

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
        $mail = (new MailMessage)
            ->subject('Membership Update — ' . $this->villageBank->name)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We regret to inform you that your membership request to **' . $this->villageBank->name . '** was not approved at this time.');

        if ($this->reason) {
            $mail->line('**Reason:** ' . $this->reason);
        }

        return $mail->line('If you have questions, please contact the village bank administrators.')
                     ->line('Thank you for your interest.');
    }

    /**
     * SMS notification via MTN Gateway.
     */
    public function toMtnSms(object $notifiable): SmsMessage
    {
        $msg = 'Your membership request to ' . $this->villageBank->name . ' was not approved.';

        if ($this->reason) {
            $msg .= ' Reason: ' . \Illuminate\Support\Str::limit($this->reason, 80);
        }

        return (new SmsMessage)->content($msg);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'village_bank_id'   => $this->villageBank->id,
            'village_bank_name' => $this->villageBank->name,
            'event'             => 'member_rejected',
            'reason'            => $this->reason,
        ];
    }
}
