<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function status()
    {
        return $this->belongsTo('App\TaskStatus');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
