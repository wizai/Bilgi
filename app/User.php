<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function Articles()
    {
        return $this->belongsToMany('App\Article');
    }
    public function Films()
    {
        return $this->belongsToMany('App\Film');
    }
    public function Hobbies()
    {
        return $this->hasMany('App\Hobby');
    }
    public function Avatar()
    {
        return $this->HasOne('App\Avatar');
    }

    public function user_films()
    {
        return $this->hasMany('App\Film');
    }
    public function user_articles()
    {
        return $this->hasMany('App\Article');
    }
}
