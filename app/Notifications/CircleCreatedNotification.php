<?php

namespace App\Notifications;

use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\VillageBank;
use App\Notifications\Channels\SmsChannel;
use App\Notifications\Channels\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CircleCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Circle $circle,
        protected VillageBank $villageBank,
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
        return (new MailMessage)
            ->subject('New Circle Created — ' . $this->circle->name)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('A new circle has been created in **' . $this->villageBank->name . '**.')
            ->line('**Circle:** ' . $this->circle->name)
            ->line('**Duration:** ' . $this->circle->duration_months . ' months')
            ->line('**Start Date:** ' . \Carbon\Carbon::parse($this->circle->start_date)->format('d M Y'))
            ->action('View Circles', url('/circles'))
            ->line('Stay engaged and make the most of your village banking experience!');
    }

    /**
     * SMS notification via MTN Gateway.
     */
    public function toMtnSms(object $notifiable): SmsMessage
    {
        return (new SmsMessage)
            ->content(
                'New circle "' . $this->circle->name . '" created in ' . $this->villageBank->name .
                '. Duration: ' . $this->circle->duration_months . ' months. Log in to view details.'
            );
    }

    public function toArray(object $notifiable): array
    {
        return [
            'circle_id'         => $this->circle->id,
            'circle_name'       => $this->circle->name,
            'village_bank_id'   => $this->villageBank->id,
            'village_bank_name' => $this->villageBank->name,
            'event'             => 'circle_created',
        ];
    }
}
