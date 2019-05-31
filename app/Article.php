<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'img', 'source', 'link', 'date'];

    public function Users()
    {
        return $this->belongsToMany('App\User');
    }

}
