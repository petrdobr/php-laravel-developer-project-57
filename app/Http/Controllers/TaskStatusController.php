<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $taskStatus = new TaskStatus();
        return view('task_statuses.create', compact('taskStatus'));
    }

    public function store(StoreTaskStatusRequest $request)
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $data = $request->validated();

        $taskStatus = new TaskStatus();
        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('messages.taskStatusCreateSuccess'))->success();
        return redirect()
            ->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $id = $taskStatus->id;
        $taskStatus = TaskStatus::find($id);
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus)
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $id = $taskStatus->id;
        $taskStatus = TaskStatus::findOrFail($id);
        $data = $request->validated();

        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('messages.taskStatusEditSuccess'))->success();
        return redirect()
            ->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $tasks = Task::where('status_id', '=', $taskStatus->id)->get();

        if ($tasks->isEmpty()) {
            $taskStatus->delete();
            flash(__('messages.taskStatusDeleteSuccess'))->success();
            return redirect()->route('task_statuses.index');
        } else {
            flash(__('messages.taskStatusDeleteError'))->error();
            return redirect()->route('task_statuses.index');
        }
    }

    public function show()
    {
        return redirect()->route('task_statuses.index');
    }
}
