<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'car_model';

    protected $fillable = [ 'title', 'make_id' ];
}