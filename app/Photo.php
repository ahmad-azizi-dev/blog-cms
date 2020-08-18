<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $path = '/images/';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getpathAttribute($photo)
    {
        return $this->path . $photo;
    }
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
