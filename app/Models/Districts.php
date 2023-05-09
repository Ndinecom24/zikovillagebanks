<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $table= 'districts';
    protected $fillable = [

        'district',
        'province_id'
    ];

    protected $with = [

        'substations'
    ];
    public function substations(){
        return $this->hasMany( ConnectionPoints::class, 'district');
    }
}
