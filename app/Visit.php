<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public function position()
    {
        return $this->hasOne('App\Position');
    }

    public function visitable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->morphTo(__FUNCTION__, 'visitor_type', 'visitor_id');
    }
}
