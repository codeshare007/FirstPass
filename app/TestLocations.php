<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestLocations extends Model
{
    protected $table = 'test_locations';

    protected $fillable = [
            'title', 'code', 'region'
        ];
}
