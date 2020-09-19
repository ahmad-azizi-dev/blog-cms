<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }
}
