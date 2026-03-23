<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxTypes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='system_taxes';

    protected $fillable= [
        'tax_code',
        'tax_regime_code',
        'rate_type_code',
        'percentage_rate',
    ];
}
