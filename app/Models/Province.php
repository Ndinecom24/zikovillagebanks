<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $fillable = [
        'province'
    ];

    protected $with = [

        'districts'
    ];
    public function districts(){
        return $this->hasMany( Districts::class, 'id');
    }

}
