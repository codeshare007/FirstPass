<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    protected $table = 'postcodes';
    public $timestamps = false;
    
    protected $fillable = [
            'status'
        ];
}
