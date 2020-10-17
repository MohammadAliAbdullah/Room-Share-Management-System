<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'country_id','name','code','status'
    ];

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }
    public function cities()
    {
        return $this->hasMany('App\City');
    }
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
