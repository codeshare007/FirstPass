<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwilioSetting extends Model
{
    protected $table = 'twilio_settings';

    protected $fillable = [
        'twilio_sid', 'twilio_token', 'from_number'
    ];
}
