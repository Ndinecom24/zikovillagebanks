<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectionPoints extends Model
{
    use HasFactory;
    protected $table ='connection_points';
    protected $fillable = [
        'district_id',
        'substation',
        'voltage_level',
        'layout',
        'firm_capacity',
        'installed_capacity',
        'substation_capacity',
        'coordinates',
        'status_id',
    ];
    public function  districts(){
        return $this->belongsTo(Districts::class,'district_id','id');
    }
}
