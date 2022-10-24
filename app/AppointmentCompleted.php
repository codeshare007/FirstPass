<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentCompleted extends Model
{
    protected $table = 'appointment_completed';

    protected $fillable = [
        'instructor_id',
        'appointment_id',
        'amount'
    ];
}
