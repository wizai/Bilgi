<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = ['name'];

    public function User()
    {
        return $this->belongsTo('App\User','foreign_key');
    }

}
