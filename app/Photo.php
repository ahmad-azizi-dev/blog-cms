<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $path = '/blog-cms/public/images/';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getpathAttribute($photo)
    {
        return $this->path . $photo;
    }
}
