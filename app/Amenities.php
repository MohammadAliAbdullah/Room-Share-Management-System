<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    protected $fillable = [
        'name', 'icon_image','status'
    ];
    public function rooms()
        {
            return $this->belongsToMany('App\Room');
        } 
}
