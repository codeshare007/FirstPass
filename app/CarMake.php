<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarMake extends Model
{
    protected $table = 'car_make';

    protected $fillable = [ 'title' ];


    public function car_maker(){
        return $this->belongsTo('App\UserMeta','vehicle_make');
    }

}