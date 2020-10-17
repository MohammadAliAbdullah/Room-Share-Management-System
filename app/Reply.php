<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function review()
    {
        return $this->belongsTo('App\Review');
    }
}
