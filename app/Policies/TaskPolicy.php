<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
{
    use HandlesAuthorization;

    public function create()
    {
        return Auth::check();
    }

    public function update()
    {
        return Auth::check();
    }

    public function delete(User $user, Task $task)
    {
        return $user->is($task->creator);
    }
}
