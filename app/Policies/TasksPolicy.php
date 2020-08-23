<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TasksPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Task $task)
    {
        return $task->creator->id === $user->id;
    }
}
