<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestPackage extends Model
{
    protected $table = 'test_package';

    protected $fillable = [
           'title', 'price', 'detail',
        ];
}
