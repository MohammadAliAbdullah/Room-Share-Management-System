<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name','code','status'];
	public function rooms()
        {
            return $this->hasMany('App\Room');
        }
        public function states()
        {
            return $this->hasMany('App\State');
        }    
}
