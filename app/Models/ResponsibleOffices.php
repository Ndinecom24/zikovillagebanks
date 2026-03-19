<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResponsibleOffices extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'responsible_offices';
    protected $fillable = ['responsible_office', 'office_status'];
}
