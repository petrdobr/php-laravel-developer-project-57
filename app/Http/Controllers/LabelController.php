<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::all();
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $label = new Label();
        return view('labels.create', compact('label'));
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
            'name' => 'required|unique:labels|min:2',
            'description' => ''
        ]);

        $label = new Label();
        $label->fill($data);
        $label->save();

        flash(__('messages.labelCreateSuccess'))->success();
        return redirect()
            ->route('labels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Label $label)
    {
        return redirect()->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $data = $this->validate($request, [
            'name' => 'required|unique:task_statuses,name,' . $label->id,
            'description' => ''
        ]);

        $label->fill($data);
        $label->save();

        flash(__('messages.labelEditSuccess'))->success();
        return redirect()
            ->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        if (! Gate::allows('change-entities')) {
            abort(403);
        }
        $tasks = $label->tasks;
        if ($label) {
            if ($tasks->isEmpty()) {
                $label->delete();
            } else {
                flash(__('messages.labelDeleteError'))->error();
                return redirect()->route('labels.index');
            }
        }
        flash(__('messages.labelDeleteSuccess'))->success();
        return redirect()->route('labels.index');
    }
}
