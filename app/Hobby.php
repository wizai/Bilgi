<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    protected $fillable = ['title'];

    public function User()
    {
        return $this->belongsTo('App\User','foreign_key');
    }
}
