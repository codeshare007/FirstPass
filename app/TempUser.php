<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TempUser extends Model
{
    protected $table = 'temp_users';

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'name',
        'lname',
        'email',
        'password',
        'phone',
        'type',
        'search_id'
    ];
}
