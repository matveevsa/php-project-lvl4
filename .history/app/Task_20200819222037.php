<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function status()
    {
        return $this->belongsTo(TaskStatus');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
