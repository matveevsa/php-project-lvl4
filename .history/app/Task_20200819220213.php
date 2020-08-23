<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function status()
    {
        return $this->belongsTo('App\TaskStatus', 'status_id');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
