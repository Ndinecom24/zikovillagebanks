<?php

namespace App\Services;


use App\Models\Contract\Contracts;
use App\Models\CreditNote;
use App\Models\Invoices\Invoice;
use App\Models\Statuses;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class HelperService
{

    public static function createInvoice($name, $sequenceName, $newFormat, $zeros)
    {

        // Fetch the next value from the Oracle sequence
        $sequenceValue = DB::selectOne('SELECT ' . $sequenceName . ' as seq FROM dual');

        // Extract the sequence number
        $nextValue = $sequenceValue->seq;

        // Generate the reference number
        $referenceNumber = $name . str_pad($nextValue, $zeros, '0', STR_PAD_LEFT) . $newFormat;

        // Output or use the reference number
        return $referenceNumber;
    }


}
