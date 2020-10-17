<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public function room()
    {
        return $this->belongsTo('App\Room');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
}
