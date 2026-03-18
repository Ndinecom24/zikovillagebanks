<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'modules';
    protected $fillable =
        [
            'module_name',
            'created_by',
            'created_by_staff_no',
        ];


    protected $with = [

        'tasks',

    ];


    public function tasks()
    {
        return $this->hasMany(ModuleTasks::class, 'module_id', 'id');
    }
}
