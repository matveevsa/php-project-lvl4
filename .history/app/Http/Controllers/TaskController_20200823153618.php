<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskStatus;
use App\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $data = $this->validate($request, [
            'name' => 'required|min:3',
            'status_id' => 'required',
        ]);

        $task = new Task();
        $task->created_by_id = auth()->user()->id;
        $task->fill($data);
        $task->save();

        flash('Status added!')->success()->important();

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
        return view('tasks.edit', $task);
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
        $data = $this->validate($request, [
            'name' => 'required|min:3',
            'status_id' => 'required',
        ]);

        $task->fill($data);
        $task->save();

        flash('Status added!')->success()->important();

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
        $this->authorize('crud-entity');

        $taskStatus->delete();

        return redirect()->route('task_statuses.index');
    }
}
