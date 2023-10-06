<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IndependentProducer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='independent_producers';
    protected $casts =[
        'date_of_application'=> 'date:Y-m-d',
        'date_of_connection'=> 'date:Y-m-d',
        'date_of_update'=> 'date:Y-m-d',
        'expected_date_commissioning'=> 'date:Y-m-d',
    ];
    protected $fillable=[

        'system_ref',
        'invoiced_services',
        'technology',
        'engagement_number',
        'name_of_ipp',
        'date_of_application',
        'size_of_plant',
        'size_of_plant_unit',
        'province_id',
        'district_id',
        'proposed_connection_point',
        'total_system_generated',
        'available_capacity',
        'voltage_level',
        'date_of_connection',
        'expiry_connection_point',
        'status_of_engagement',
        'updates_on_engagements',
//        'doc_type',
        'date_of_update',
        'updated_by',
        'contact_person_name',
        'contact_person_email',
        'contact_person_phone',
        'type_of_venture',
        'expected_date_commissioning',
        'expected_commercial',
        'preferred_connection_level',
        'ipp_tariff',
        'status_id'


    ];

protected $with =[
    'province',
    'districts',

];



//    public function province(){
//        return $this->hasMany( Province::class, 'province_id','id');
//    }
//    public function districts(){
//        return $this->hasMany( Districts::class, 'district_id','id');
//    }


    public function  province(){
        return $this->belongsTo(Province::class,'province_id','id');
    }

    public function  districts(){
        return $this->belongsTo(Districts::class,'district_id','id');
    }



//    public static function booted(){
//
//
//        if( auth()->check() ) {
//
//            $user = auth()->user();
//
//            $man_number = $user->staff_no ;
//
//            if ($user->usertype == '1') {
//                static::addGlobalScope('approve', function (Builder $builder) use ($man_number) {
//                    $builder->where('man_number', $man_number );
//                });
//            } else {
////                dd('admin user');
//            }
//
//        }
//    }
}

