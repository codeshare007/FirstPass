<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'constructor_id',
        'user_id',
        'schedule_date',
        'time_slot',
        'status',
        'payment_status',
        'search_id',
        'lesson_hour',
        'hourly_rate',
        'amount',
        'type',
        'is_private',
        'detail',
        'note',
        'address',
        'start_date',
        'end_date',
        'test_location'
    ];
}
