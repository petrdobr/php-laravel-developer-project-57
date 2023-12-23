<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::paginate();
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

        $statusesArray = [];
        foreach ($statuses as $status) {
            $statusesArray[$status->id] = $status->name;
        }
        $usersArray = [];
        foreach ($users as $user) {
            $usersArray[$user->id] = $user->name;
        }

        return view('tasks.create', compact(['task', 'statusesArray', 'usersArray']));
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
            'description' => 'min:2',
            'status_id' => '',
            'assigned_to_id' => '',
        ]);
        $data['created_by_id'] = 1;

        $task = new Task();
        $task->fill($data);
        $task->save();

        flash('Статус успешно создан')->success();
        return redirect()
            ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
