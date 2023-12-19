<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Gate;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        if (! Gate::allows('create-task-status')) {
            abort(403);
        }
        $taskStatus = new TaskStatus();
        return view('task_statuses.create', compact('taskStatus'));
    }

    public function store(Request $request)
    {
        if (! Gate::allows('create-task-status')) {
            abort(403);
        }
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
        if (! Gate::allows('update-task-status')) {
            abort(403);
        }
        $id = $taskStatus->id;
        $taskStatus = TaskStatus::find($id);
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        if (! Gate::allows('update-task-status')) {
            abort(403);
        }
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
        if (! Gate::allows('destroy-task-status')) {
            abort(403);
        }
        if ($taskStatus) {
            $taskStatus->delete();
        }
        return redirect()->route('task_statuses.index');
    }

    public function show()
    {
        return redirect()->route('task_statuses.index');
    }
}
