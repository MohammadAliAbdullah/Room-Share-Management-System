<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Writer_profile extends Model
{
    
    protected $fillable = [
        'title', 'description','nid','phone','school','work','languages','image','status'
    ];
    public function writer()
    {
        return $this->belongsTo('App\Writer');
    }
}
