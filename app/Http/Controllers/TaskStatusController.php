<?php

namespace App\Http\Controllers;

use App\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'task_status', ['except' => ['index']]);
    }

    public function index()
    {
        $statuses = TaskStatus::all()->sortByDesc('updated_at');

        return view('task_statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('task_statuses.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|min:3|unique:task_statuses'
        ]);

        $status = new TaskStatus();
        $status->fill($data);
        $status->save();

        flash(__('task_statuses.store'))->success()->important();

        return redirect()->route('task_statuses.index');
    }


    public function edit(TaskStatus $taskStatus)
    {
        $this->authorize($taskStatus);

        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $data = $this->validate($request, [
            'name' => 'required|min:3|unique:task_statuses,name,' . $taskStatus->id
        ]);

        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('task_statuses.update'))->success()->important();

        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        $taskStatus->delete();

        flash(__('task_statuses.destroy'))->success()->important();

        return redirect()->route('task_statuses.index');
    }
}
