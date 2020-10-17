<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'title', 'description','latitude','longitude','price'
    ];
    public function writer()
    {
        return $this->belongsTo('App\Writer');
    }
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
    public function state()
    {
        return $this->belongsTo('App\State');
    }
    public function city()
    {
        return $this->belongsTo('App\City');
    }
    public function photos()
        {
            return $this->hasMany('App\Photo');
        }
    public function amenities()
        {
            return $this->belongsToMany('App\Amenities');
        }
    public function bookings()
        {
            return $this->hasMany('App\Booking');
        } 
    public function reviews()
        {
            return $this->hasMany('App\Review');
        }
    public function category()
        {
            return $this->belongsTo('App\Category');
        }
        public function subcategory()
        {
            return $this->belongsTo('App\Subcategory');
        }                   
}
