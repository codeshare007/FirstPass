<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailSettings extends Model
{
    protected $table = 'email_settings';

    protected $fillable = [
        'confirm_subject' ,
        'block_subject',
        'signup_subject',
        'newuser_subject',
        'usercancel_subject',
        'appt_subject',
        'signup_body',
        'block_body',
        'confirm_body',
        'new_body',
        'cancel_body',
        'appt_body'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
