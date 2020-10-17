<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description','status'
    ];
    public function subcategory()
        {
            return $this->hasMany('App\Subcategory');
        }
    public function rooms()
    {
        return $this->hasMany('App\Room');
    }
}
