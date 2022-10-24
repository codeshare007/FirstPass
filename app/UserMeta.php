<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $table = 'user_meta';

    protected $fillable = [
        'user_id',
        'transmission_type',
        'language',
        'bio',
        'years_for_instructing',
        'keys2drive',
        'services_accreditation',
        'association_member',
        // 'dual_controls',
        // 'vehicle_year',
        // 'vehicle_model',
        // 'vehicle_make',
        // 'registration_number',
        'association_name',
        // 'ancap_rating',
        'driving_licence',
        'driving_instructor_licence',
        'wwcc',
        'wwcc_status',
        'vehicle_image'
        ];

    public function user_meta(){
        return $this->belongsTo('App\User','vehicle_make');
    }

    public function car_maker()
    {
        return $this->hasOne('App\CarMake', '');
    }

    public function driving_licence(){
        return $this->belongsTo('App\DrivingLicence','driving_licence_id','id');
    }

    public function instructor_licence(){
        return $this->belongsTo('App\InstructorLicence','instructor_licence_id','id');
    }

    public function wwcc_licence(){
        return $this->belongsTo('App\WwccLicence','wwcc_licence_id','id');
    }
}