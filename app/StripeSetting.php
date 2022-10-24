<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripeSetting extends Model
{
    protected $fillable = [
        'public_key',
        'secret_key',
        'client_id',
        'user_id'
    ];
}
