<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YearModel extends Model
{
    protected $table = 'car_year';

    protected $fillable = [ 'title', 'model_id', 'image' ];
}
