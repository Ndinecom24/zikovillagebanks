<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banks extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'banks';
    protected $fillable =
        [
            'account_name',
            'account_no',
            'branch',
            'currency',
            'bank_name',
            'swift_address',
            'created_by',
            'created_by_staff_no',
        ];
}
