<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lname',
        'preferred_name',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'postcode',
        'type',
        'remember_token',
        'gender',
        'avatar',
        'status',
        'calendar_default_view',
        'message',
        'lesson_travel_time'
    ];

    public function user_meta()
    {
        return $this->hasOne('App\UserMeta');
    }

    public function user_vehicle_manual(){
        return $this->hasOneThrough(
            'App\InstructerVehicle',
            'App\UserMeta',
            'user_id', // Foreign key on UserMeta table...
            'id', // Foreign key on InstructerVehicle table...
            'id', // Local key on users table...
            'vehicle_manual_id' // Local key on UserMeta table...
        );
    }

    public function user_vehicle_auto(){
        return $this->hasOneThrough(
            'App\InstructerVehicle',
            'App\UserMeta',
            'user_id', // Foreign key on UserMeta table...
            'id', // Foreign key on InstructerVehicle table...
            'id', // Local key on users table...
            'vehicle_auto_id' // Local key on UserMeta table...
        );
    }

    public function wwccLicence(){
        return $this->hasOneThrough(
            'App\WwccLicence',
            'App\UserMeta',
            'user_id', // Foreign key on UserMeta table...
            'id', // Foreign key on DrivingLicence table...
            'id', // Local key on users table...
            'wwcc_licence_id' // Local key on UserMeta table...
        );
    }
}
