<?php

namespace App\Http\Livewire\DailyExchangeRates;

use App\Jobs\SyncDailyRatesJob;
use App\Models\BulkDailyRates;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class DailyRates extends Component
{

    use WithPagination;

    public $rates_id;
    protected $paginationTheme = 'bootstrap';



    public function syncDailyRate()
    {
//        dd($fms_daily_rates);
        SyncDailyRatesJob::dispatch();
        session()->flash('message',  ' FMS Daily Rates for the year '. Carbon::now()->year.' synchronization job dispatched successfully.');


    }
    public function render()

    {
        $rates = BulkDailyRates::orderBy('creation_date', 'DESC')->paginate(20);

        return view('livewire.daily-exchange-rates.daily-rates');
    }
}
