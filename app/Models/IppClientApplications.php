<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IppClientApplications extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ipp_client_applications';
    protected $fillable =
        [
            'client_id',
            'developer_name',
            'technology_id',
            'invoice_services',
            'application_date',
            'proposed_size_of_connection',
            'proposed_size_of_connection_unit',
            'actual_size_of_given_connection',
            'actual_size_of_given_unit',
            'province_id',
            'district_id',
            'connection_point_id',
            'created_by',
            'created_by_staff_no',
            'type_of_venture_id',
            'installed_capacity',
            'application_comments'
        ];
}
