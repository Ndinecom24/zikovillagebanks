<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GisQuotations extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'gis_quotations';
    protected $fillable = [
        'quotation_no',
        'client_id',
        'quotation_date',
        'currency',
        'exchange_rate',
        'unit_desc',
        'quotation_final_kwacha',
        'quotation_final',
        'vat',
        'vat_value',
        'full_justification',
        'uuid',
        'created_by',
        'created_by_staff_no',
        'bank_id',

    ];

    public function clients()
    {
        return $this->belongsTo(ClientDetails::class, 'client_id', 'id');
    }
}
