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
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $labels = Arr::pluck(Label::all(), 'name', 'id');
        $statuses = Arr::pluck(TaskStatus::all(), 'name', 'id');
        $users = Arr::pluck(User::all(), 'name', 'id');

        return view('tasks.index', compact('tasks', 'labels', 'statuses', 'users', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('crud-entity');

        $labels = Arr::pluck(Label::all(), 'name', 'id');
        $statuses = Arr::pluck(TaskStatus::all(), 'name', 'id');
        $users = Arr::pluck(User::all(), 'name', 'id');

        return view('tasks.create', [
            'statuses' => $statuses,
            'users' => $users,
            'labels' => $labels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTask $request)
    {
        $this->authorize('crud-entity');

        $data = $request->validated();

        $userId = Auth::user()->id;
        $task = User::find($userId)->createdTasks()->make();

        $task->fill($data);
        $task->save();

        flash(__('tasks.store'))->success()->important();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('crud-entity');

        $labels = Arr::pluck(Label::all(), 'name', 'id');
        $statuses = Arr::pluck(TaskStatus::all(), 'name', 'id');
        $users = Arr::pluck(User::all(), 'name', 'id');

        return view('tasks.edit', [
            'task' => $task,
            'statuses' => $statuses,
            'users' => $users,
            'labels' => $labels,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTask $request, Task $task)
    {
        $this->authorize('crud-entity');

        $data = $request->validated();

        $userId = Auth::user()->id;
        $task = User::find($userId)->createdTasks()->findOrFail($task->id);

        $task->fill($data);
        $task->save();

        flash(__('tasks.update'))->success()->important();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        // $this->authorize('task-delete', $task);

        $task->delete();

        flash(__('tasks.destroy'))->success()->important();

        return redirect()->route('tasks.index');
    }
}
