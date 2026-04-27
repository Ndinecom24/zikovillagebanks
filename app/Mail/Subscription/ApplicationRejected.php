<?php

namespace App\Mail\Subscription;

use App\Models\Subscription\BankApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationRejected extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct(BankApplication $application)
    {
        $this->application = $application;
    }

    public function build()
    {
        return $this->subject('Application Update — Village Banking Platform')
            ->view('emails.subscription.application-rejected');
    }
}
