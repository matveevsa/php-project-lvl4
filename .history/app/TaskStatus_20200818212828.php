<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $fillable = ['name'];

    public function task()
    {
        return $this->hasMany('App\Task');
    }
}
