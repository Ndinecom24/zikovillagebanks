<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $table= 'districts';
    protected $with = ['connectionPoint'];
    protected $fillable = [

        'province_id',
        'district',


    ];


    public function  province(){
        return $this->belongsTo(Province::class,'province_id','id');
    }

//    protected $with = [
//
//        'connectionPoint'
//    ];
    public function connectionPoint(){
        return $this->hasMany( ConnectionPoints::class, 'district_id','id');
    }


}
