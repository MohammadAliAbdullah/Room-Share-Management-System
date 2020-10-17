<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model

{   
    protected $fillable = [
        'room_id', 'user_id', 'booking_id','comment','accuracy','location', 'checkin','cleanliness','value'
    ];
    public function replies()
    {
        return $this->hasMany('App\Replies');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function rooms()
    {
        return $this->belongsTo('App\Room');
    }
    
}
