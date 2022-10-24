<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'smtp_host',
        'smtp_port',
        'use_ssl',
        'email_type',
        'smtp_username',
        'smtp_password',
        'smtp_fname',
        'smtp_femail',
        'email_api',
        'sp_email',
        'sp_fname',
        'sp_apikey',
        'sp_rkey',
        'sg_email',
        'sg_fname',
        'sg_apikey',
        'userid',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
