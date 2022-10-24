<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstructorDocs extends Model
{
    protected $table = 'instructor_docs';

    protected $fillable = [
        'user_id',
        'driving_licence',
        'instructor_licence',
        'wwcc',
        ];

    public function user_meta(){
        return $this->belongsTo('App\User','user_id');
    }
}
