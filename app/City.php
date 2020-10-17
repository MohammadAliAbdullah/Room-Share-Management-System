<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'state_id', 'name','status'
    ];

    public function rooms()
        {
            return $this->hasMany('App\Room');
        }
        public function state()
        {
            return $this->belongsTo('App\State');
        }    
}
