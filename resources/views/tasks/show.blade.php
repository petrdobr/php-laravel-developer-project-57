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
        <div class="flex w-40 justify-start">
            @include('flash::message')
        </div>
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
            @foreach($labels as $label)
             <div class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full">
                    {{ $label->name }} 
             </div>
            @endforeach
        </p>
</div>
</div>
@endsection
