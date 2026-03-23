<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GisQuotationsItems extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'gis_quotations_items';
    protected $fillable =
        [
            'quotation_id',
            'description',
            'quantity',
            'unit_price',
            'total',
        ];
}
