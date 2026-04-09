<?php

namespace App\Mail\Subscription;

use App\Models\Subscription\License;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LicenseExpiryAdminAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $license;
    public $daysRemaining;
    public $bankName;

    public function __construct(License $license)
    {
        $this->license = $license;
        $this->daysRemaining = $license->daysRemaining();
        $this->bankName = $license->villageBank ? $license->villageBank->name : 'Unknown';
    }

    public function build()
    {
        return $this->subject("License Expiry Alert: {$this->bankName} — {$this->daysRemaining} days remaining")
            ->view('emails.subscription.license-expiry-admin');
    }
}
