<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSlots extends Model
{
    protected $table = 'time_slots';

    protected $fillable = [
        'time_name' ,'time_value', 'is_enabled'
        ];
}
