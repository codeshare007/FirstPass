<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRatings extends Model
{
    protected $table = 'user_rating';

    protected $fillable = [
           'score', 'by_user', 'user_id', 'review'
        ];
}
