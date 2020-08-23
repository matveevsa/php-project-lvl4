<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name'];
    
    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
