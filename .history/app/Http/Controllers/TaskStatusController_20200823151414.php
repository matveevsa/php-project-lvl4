<?php

namespace App\Http\Controllers;

use App\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
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
        $statuses = TaskStatus::all()->sortByDesc('updated_at');

        return view('task_statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('crud-status');

        return view('task_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('crud-status');

        $data = $this->validate($request, [
            'name' => 'required|min:3|unique:task_statuses'
        ]);

        $status = new TaskStatus();
        $status->fill($data);
        $status->save();

        flash('Status added!')->success()->important();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function show(TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        $this->authorize('crud-status');

        return view('task_statuses.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        $this->authorize('crud-status');

        $data = $this->validate($request, [
            'name' => 'required|min:3|unique:task_statuses'
        ]);

        $taskStatus->fill($data);
        $taskStatus->save();

        flash('Status updated!')->success()->important();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskStatus $taskStatus)
    {
        $this->authorize('crud-status');

        $taskStatus->delete();

        return redirect()->route('task_statuses.index');
    }
}
