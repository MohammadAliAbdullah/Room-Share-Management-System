<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'name', 'details','room_id'
    ];
    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}
