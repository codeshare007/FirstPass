<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingTime extends Model
{
    protected $table = 'working_time';

    protected $fillable = [
            'user_id', 'day', 'start_time', 'end_time', 'data', 'is_enabled'
        ];
}
