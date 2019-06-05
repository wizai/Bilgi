<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['title', 'body', 'affiche', 'img', 'note', 'date'];

    public function Users()
    {
        return $this->belongsToMany('App\User');
    }
}
