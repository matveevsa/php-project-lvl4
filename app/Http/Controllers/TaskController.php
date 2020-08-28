<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use App\Label;
use Illuminate\Http\Request;
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

        $labels = $this->pluckNameId(Label::class);
        $statuses = $this->pluckNameId(TaskStatus::class);
        $users = $this->pluckNameId(User::class);

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

        $labels = $this->pluckNameId(Label::class);
        $statuses = $this->pluckNameId(TaskStatus::class);
        $users = $this->pluckNameId(User::class);

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
    public function store(Request $request)
    {
        $this->authorize('crud-entity');

        $data = $this->validate($request, [
            'name' => 'required|min:3|unique:tasks',
            'status_id' => 'required',
            'description' => 'nullable',
            'assigned_to_id' => 'nullable'
        ]);

        $task = new Task();
        $task->created_by_id = auth()->user()->id;
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

        $labels = $this->pluckNameId(Label::class);
        $statuses = $this->pluckNameId(TaskStatus::class);
        $users = $this->pluckNameId(User::class);

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
    public function update(Request $request, Task $task)
    {
        $this->authorize('crud-entity');

        $data = $this->validate($request, [
            'name' => 'required|min:3|unique:tasks,name' . $task->id,
            'status_id' => 'required',
            'description' => 'nullable',
            'assigned_to_id' => 'nullable'
        ]);

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
        $this->authorize('task-delete', $task);

        $task->delete();

        flash(__('tasks.destroy'))->success()->important();

        return redirect()->route('tasks.index');
    }

    private function pluckNameId($class)
    {
        return $class::select(['id', 'name'])
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}
