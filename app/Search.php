<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = 'search';

    protected $fillable = [

            'ip' ,'region_id', 't_type', 'step_2', 'step_3','step_4', 'learner_id'

        ];
}
