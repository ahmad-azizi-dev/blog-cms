<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Shetabit\Visitor\Traits\Visitable;

class Post extends Model
{
    use Visitable;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function cat()
    {
        return $this->belongsTo('App\Cat');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
