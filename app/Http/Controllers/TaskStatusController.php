<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        $taskStatus = new TaskStatus();
        return view('task_statuses.create', compact('taskStatus'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses|min:2'
        ]);

        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();

        return redirect()
            ->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        $id = $taskStatus->id;
        $taskStatus = TaskStatus::find($id);
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $id = $taskStatus->id;
        $taskStatus = TaskStatus::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses,name,' . $taskStatus->id,
        ]);

        $taskStatus->fill($data);
        $taskStatus->save();
        return redirect()
            ->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus) {
            $taskStatus->delete();
        }
        return redirect()->route('task_statuses.index');
    }

    public function show(TaskStatus $taskStatus)
    {
        $id = $taskStatus->id;
        $taskStatus = TaskStatus::findOrFail($id);
        return redirect()->route('task_statuses.index');
    }
}
