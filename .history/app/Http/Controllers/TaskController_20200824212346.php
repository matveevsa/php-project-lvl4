<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use Illuminate\Http\Request;

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
    public function index()
    {
        $tasks = Task::orderBy('updated_at', 'desc')->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('crud-entity');

        $labels = Label::get();

        $statuses = TaskStatus::select(['id', 'name'])
            ->get()
            ->pluck('name', 'id')
            ->toArray();

        $users = User::select(['id', 'name'])
            ->get()
            ->pluck('name', 'id')
            ->toArray();

        return view('tasks.create', [
            'statuses' => $statuses,
            'users' => $users
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
            'name' => 'required|min:3',
            'status_id' => 'required',
            'description' => 'nullable',
            'assigned_to_id' => 'nullable'
        ]);

        $task = new Task();
        $task->created_by_id = auth()->user()->id;
        $task->fill($data);
        $task->save();

        flash('Task added!')->success()->important();

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

        $statuses = TaskStatus::select(['id', 'name'])
            ->get()
            ->pluck('name', 'id')
            ->toArray();

        $users = User::select(['id', 'name'])
            ->get()
            ->pluck('name', 'id')
            ->toArray();

        return view('tasks.edit', [
            'task' => $task,
            'statuses' => $statuses,
            'users' => $users
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
            'name' => 'required|min:3',
            'status_id' => 'required',
            'description' => 'nullable',
            'assigned_to_id' => 'nullable'
        ]);

        $task->fill($data);
        $task->save();

        flash('Task updated!')->success()->important();

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

        return redirect()->route('tasks.index');
    }
}
