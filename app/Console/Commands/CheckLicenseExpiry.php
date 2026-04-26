<?php

namespace App\Console\Commands;

use App\Models\Subscription\License;
use Illuminate\Console\Command;

class CheckLicenseExpiry extends Command
{
    protected $signature = 'licenses:check-expiry';

    protected $description = 'Mark expired licenses and their subscriptions as expired';

    public function handle()
    {
        $expired = License::where('status', 'active')
            ->where('expires_at', '<', now())
            ->get();

        $count = 0;

        foreach ($expired as $license) {
            $license->update(['status' => 'expired']);

            if ($license->subscription) {
                $license->subscription->update(['status' => 'expired']);
            }

            $count++;
        }

        $this->info("Marked {$count} license(s) as expired.");

        return 0;
    }
}
