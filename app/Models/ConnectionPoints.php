<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectionPoints extends Model
{
    use HasFactory;
    protected $table ='';
    protected $fillable = [
        'district_id',
        'substation',
        'voltage_level',
        'layout',
        'firm_capacity',
        'installed_capacity',
        'substation_capacity',
        'status_id',
    ];

}
