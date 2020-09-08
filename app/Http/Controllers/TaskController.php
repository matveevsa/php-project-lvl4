<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;
use App\Task;
use App\TaskStatus;
use App\User;
use App\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        $this->authorizeResource(Task::class, 'task', ['except' => ['index']]);
    }

    public function index(Request $request)
    {
        $filter = $request->query('filter') ?? [];

        $tasks = (empty($filter)
            ? Task::orderBy('updated_at', 'desc')->get()
            : QueryBuilder::for(Task::class)
                ->allowedFilters([
                    AllowedFilter::exact('status_id'),
                    AllowedFilter::exact('created_by_id'),
                    AllowedFilter::exact('assigned_to_id')
                    ])
                ->get()
            );

        $labels = Label::pluck('name', 'id');
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('tasks.index', compact('tasks', 'labels', 'statuses', 'users', 'filter'));
    }

    public function create()
    {
        $labels = Label::pluck('name', 'id');
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('tasks.create', [
            'statuses' => $statuses,
            'users' => $users,
            'labels' => $labels
        ]);
    }

    public function store(StoreTask $request)
    {
        $data = $request->validated();

        $task = auth()
            ->user()
            ->createdTasks()
            ->make();

        $task->fill($data);
        $task->save();

        flash(__('tasks.store'))->success()->important();

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        $labels = Label::pluck('name', 'id');
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('tasks.edit', [
            'task' => $task,
            'statuses' => $statuses,
            'users' => $users,
            'labels' => $labels,
        ]);
    }

    public function update(UpdateTask $request, Task $task)
    {
        $data = $request->validated();

        $task->fill($data);
        $task->save();

        flash(__('tasks.update'))->success()->important();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task, User $user)
    {
        $task->delete();

        flash(__('tasks.destroy'))->success()->important();

        return redirect()->route('tasks.index');
    }
}
