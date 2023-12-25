<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate(15);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $task = new Task();
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();


        $statusesArray = [];
        foreach ($statuses as $status) {
            $statusesArray[$status->id] = $status->name;
        }
        $usersArray = [];
        foreach ($users as $user) {
            $usersArray[$user->id] = $user->name;
        }
        $labelsArray = [];
        foreach ($labels as $label) {
            $labelsArray[$label->id] = $label->name;
        }

        return view('tasks.create', compact(['task', 'statusesArray', 'usersArray', 'labelsArray']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $data = $this->validate($request, [
            'name' => 'required|unique:tasks|min:2',
            'status_id' => 'integer',
            'assigned_to_id' => 'integer',
        ]);
        $this->validate($request, [
            'labels' => 'required'
        ]);
        $data['created_by_id'] = $request->user()->id;
        $task = new Task();
        $task->fill($data);
        $task->save();

        $labelIDs = $request['labels'];
        $task->labels()->attach($labelIDs);

        flash(__('messages.taskCreateSuccess'))->success();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $labels = $task->labels()->get();
        return view('tasks.show', compact('task', 'labels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        $statusesArray = [];
        foreach ($statuses as $status) {
            $statusesArray[$status->id] = $status->name;
        }
        $usersArray = [];
        foreach ($users as $user) {
            $usersArray[$user->id] = $user->name;
        }
        $labelsArray = [];
        foreach ($labels as $label) {
            $labelsArray[$label->id] = $label->name;
        }
        return view('tasks.edit', compact(['task', 'statusesArray', 'usersArray', 'labelsArray']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $id = $task->id;
        $task = Task::findOrFail($id);
        $data = $this->validate($request, [
            'name' => 'required|unique:tasks,name,' . $id,
            'description' => '',
            'status_id' => 'integer',
            'created_by_id' => 'integer',
            'assigned_to_id' => 'integer',
        ]);
        $this->validate($request, [
            'labels' => 'required'
        ]);
        $task->fill($data);
        $task->save();
        $task->labels()->detach();
        $labelIDs = $request['labels'];
        $task->labels()->attach($labelIDs);

        flash(__('messages.taskEditSuccess'))->success();
        return redirect()
            ->route('tasks.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }

        if (! Gate::allows('delete-task', $task)) {
            flash(__('messages.taskDeleteSuccess'))->error();
            return redirect()->route('tasks.index');
        }

        if ($task) {
            $task->delete();
        }
        flash(__('messages.taskDeleteSuccess'))->success();
        return redirect()->route('tasks.index');
    }
}
