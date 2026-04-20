<?php

namespace App\Mail\Subscription;

use App\Models\Subscription\BankApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewApplicationAdminAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct(BankApplication $application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->subject('New Application Pending — ' . $this->application->bank_name)
            ->view('emails.subscription.new-application-admin');
    }
}
