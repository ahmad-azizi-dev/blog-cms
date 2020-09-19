<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public function position()
    {
        return $this->hasOne('App\Position');
    }
}
