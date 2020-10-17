<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable=['message','type','note_id','seen'];
    public function notifiable()
    {
        return $this->morphTo();
    }
}
