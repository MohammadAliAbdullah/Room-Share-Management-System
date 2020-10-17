<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Writer extends Authenticatable
{
    use Notifiable;

        protected $guard = 'writer';

        protected $fillable = [
            'name', 'email', 'password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
        public function rooms()
        {
            return $this->hasMany('App\Room');
        }
        public function profile()
        {
            return $this->hasOne('App\Writer_profile');
        }
        public function replies()
        {
            return $this->hasMany('App\Reply');
        }
        public function notifications()
        {
            return $this->morphMany('App\Notification', 'notifiable');
        } 
}
