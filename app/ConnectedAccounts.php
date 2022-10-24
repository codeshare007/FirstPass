<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConnectedAccounts extends Model
{
    protected $fillable = [
        'user_id',
        'access_token',
        'refresh_token',
        'stripe_publishable_key',
        'stripe_user_id',
        'access_token',
        'response',

    ];
}
