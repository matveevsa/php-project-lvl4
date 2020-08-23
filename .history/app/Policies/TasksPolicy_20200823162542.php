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
        dd($task->creator->id === $user->id);
        return $task->creator === $user->id;
    }
}
