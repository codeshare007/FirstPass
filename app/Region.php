<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    protected $fillable = ['title', 'reg_id', 'code', 'price', 'data', 'ez_id'];
}
