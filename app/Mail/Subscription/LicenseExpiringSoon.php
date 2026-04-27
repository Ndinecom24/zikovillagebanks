<?php

namespace App\Mail\Subscription;

use App\Models\Subscription\License;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LicenseExpiringSoon extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $license;
    public $daysRemaining;

    public function __construct(License $license)
    {
        $this->license = $license;
        $this->daysRemaining = $license->daysRemaining();
    }

    public function build()
    {
        return $this->subject('License Expiring Soon — Village Banking Platform')
            ->view('emails.subscription.license-expiring');
    }
}
