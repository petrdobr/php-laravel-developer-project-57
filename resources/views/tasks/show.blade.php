@extends('layouts.app')
@section('content')

<div class="grid max-w-screen-xl px-4 pb-8 mx-auto mt-16">
    <div class="grid col-span-full">
        <h2 class="mt-8 mb-4">
            {{ __('messages.taskShow') . ': ' . $task->name . " "}}
            @auth
            <a href="{{ route('tasks.edit', $task) }}">
                {{ __('messages.editTaskIcon') }}
            </a>
            @endauth
        </h2>
            @include('flash::message')
        <p><b>
            {{ __('messages.taskName') . ': ' }}
        </b>
            {{ $task->name }}
        </p>
        <p><b>
            {{ __('messages.taskStatus') . ': ' }}
        </b>
            {{ $task->status->name }}
        </p>
        <p><b>
            {{ __('messages.taskDescription') . ': ' }}
        </b>
            {{ $task->description }}
        </p>
        <p><b>
            {{ __('messages.labels') . ': ' }}
        </b><br>
            {{ 'Here will be labels' }}
        </p>
</div>
</div>
@endsection
