<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTestLocations extends Model
{
    protected $table = 'user_test_locations';

    protected $fillable = [
        'user_id', 'location_id'
        ];
}
