<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Shetabit\Visitor\Traits\Visitable;

class Cat extends Model
{
    use Visitable;

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
