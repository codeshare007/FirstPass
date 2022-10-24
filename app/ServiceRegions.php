<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRegions extends Model
{
    protected $table = 'service_regions';

    protected $fillable = [
            'user_id', 'region_id', 'status',
        ];


    public function region(){
        return $this->belongsTo('App\Region');
    }

}
