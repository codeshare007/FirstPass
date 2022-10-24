<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = ['id'];

    public function instructer_vehicles(){
        return $this->belongsTo('App\InstructerVehicle','notify_request_id','id');
    }

    public function instructer_info(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
