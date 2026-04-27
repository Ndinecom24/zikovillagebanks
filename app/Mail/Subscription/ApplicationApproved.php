<?php

namespace App\Mail\Subscription;

use App\Models\Subscription\BankApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationApproved extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $application;
    public $licenseKey;
    public $staffNo;
    public $defaultPassword;

    public function __construct(BankApplication $application, string $licenseKey, string $staffNo, string $defaultPassword)
    {
        $this->application = $application;
        $this->licenseKey = $licenseKey;
        $this->staffNo = $staffNo;
        $this->defaultPassword = $defaultPassword;
    }

    public function build()
    {
        return $this->subject('Application Approved — Village Banking Platform')
            ->view('emails.subscription.application-approved');
    }
}
