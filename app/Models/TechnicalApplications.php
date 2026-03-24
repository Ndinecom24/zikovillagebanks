<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TechnicalApplications extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'technical_applications';
    protected $fillable = [
        'client_id',
        'project_name',
        'province_id',
        'connection_point_id',
        'technology_id',
        'district_id',
        'proposed_generation_capacity',
        'proposed_generation_capacity_units',
        'application_comments',
        'created_by' ,
        'created_by_staff_no' ,
    ];

}
