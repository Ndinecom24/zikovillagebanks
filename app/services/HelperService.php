<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class HelperService
{
    /**
     * Generate a formatted reference number using a database sequence.
     *
     * @param  string  $prefix   Prefix for the reference (e.g. "INV")
     * @param  string  $table    Table name to count from (used as sequence source)
     * @param  string  $suffix   Suffix appended after the number
     * @param  int     $padding  Number of zero-padded digits
     * @return string
     */
    public static function generateReference(string $prefix, string $table, string $suffix = '', int $padding = 6): string
    {
        // Use a safe parameterised count instead of raw SQL concatenation
        $nextValue = DB::table($table)->count() + 1;

        return $prefix . str_pad($nextValue, $padding, '0', STR_PAD_LEFT) . $suffix;
    }
}
