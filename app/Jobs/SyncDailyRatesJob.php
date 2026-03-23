<?php

namespace App\Jobs;

use App\Models\BulkDailyRates;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncDailyRatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        ini_set("memory_limit", -1);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Get the current year
        $currentYear = Carbon::now()->year;
// $currentYear = '2024';

// Fetch records from the current year
        $fms_daily_rates = BulkDailyRates::whereYear('creation_date', $currentYear)
            ->orderBy('creation_date', 'asc')
            ->get();


        foreach ($fms_daily_rates->chunk(500) as $chunk) {
            foreach ($chunk as $fms_daily_rate) {
                if (!empty($fms_daily_rate->from_currency) || !empty($fms_daily_rate->to_currency)) {
                    BulkDailyRates::updateOrCreate(
                        [
                            'from_currency' => $fms_daily_rate->from_currency ?? "0",
                            'to_currency' => $fms_daily_rate->to_currency ?? "0",
                            'conversion_date' => Carbon::parse($fms_daily_rate->conversion_date ?? "0"),
                            'conversion_type' => $fms_daily_rate->conversion_type ?? "0",
                            'conversion_rate' => $fms_daily_rate->conversion_rate ?? "0",
                            'creation_date' => Carbon::parse($fms_daily_rate->creation_date ?? "0"),
                        ],
                        [
                            'from_currency' => $fms_daily_rate->from_currency ?? "0",
                            'to_currency' => $fms_daily_rate->to_currency ?? "0",
                            'conversion_date' => Carbon::parse($fms_daily_rate->conversion_date ?? "0"),
                            'conversion_type' => $fms_daily_rate->conversion_type ?? "0",
                            'conversion_rate' => $fms_daily_rate->conversion_rate ?? "0",
                            'creation_date' => Carbon::parse($fms_daily_rate->creation_date ?? "0"),
                        ]
                    );
                }
            }
        }
    }
}
