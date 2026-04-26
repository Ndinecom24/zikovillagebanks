<?php

namespace App\Notifications\Channels;

/**
 * A simple DTO representing an SMS message to be sent via the MtnSmsService.
 *
 * Usage in a Notification:
 *
 *     public function toMtnSms($notifiable): SmsMessage
 *     {
 *         return (new SmsMessage)
 *             ->to($notifiable->mobile_no)
 *             ->content('Your OTP is 1234');
 *     }
 */
class SmsMessage
{
    public ?string $recipient = null;
    public string $content = '';
    public ?string $senderAddress = null;
    public ?string $serviceCode = null;

    /**
     * Set the recipient number.
     */
    public function to(string $number): static
    {
        $this->recipient = $number;

        return $this;
    }

    /**
     * Set the message body.
     */
    public function content(string $message): static
    {
        $this->content = $message;

        return $this;
    }

    /**
     * Override the sender address / name (optional).
     */
    public function from(string $senderAddress): static
    {
        $this->senderAddress = $senderAddress;

        return $this;
    }

    /**
     * Override the service code (optional).
     */
    public function serviceCode(string $code): static
    {
        $this->serviceCode = $code;

        return $this;
    }
}
