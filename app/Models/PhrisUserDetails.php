<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhrisUserDetails extends Model
{
    use HasFactory;

    protected $connection = 'oracle_phris';
    //table name
    protected $table  = 'ipa_phris_view';


    public $incrementing = false;
    protected $keyType = 'string';

    //fields fillable
    protected $fillable = [
        'name',
        'bu_code',
        'cc_code',
        'man_no',
        'nrc',
        'dob',
        'sex',

        'email',
        'mobile_no',

        'password',

        'access_token',

        'user_access_level_id',
        'user_group_id',
        'status',

        'profile_unit_code',
        'profile_job_code',
        'job_code',
        'job_title',
        'grade',

        'user_unit_code',
        'user_unit_id',

        'directorate',
        'location',
        'station',
        'pay_point',
        'functional_section',

        'contract_type',
        'con_st_code',
        'con_wef_date',
        'con_wet_date',
        'previous_login',
    ];
}
