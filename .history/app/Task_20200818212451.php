<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function status()
    {
        return $this->hasOne('App\TaskStatus');
    }
}
