<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleTasks extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'module_tasks';
    protected $fillable =
        [
            'task_name',
            'task_description',
            'office_id',
            'module_id',
            'created_by',
            'created_by_staff_no',
        ];


}
