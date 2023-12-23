@extends('layouts.app')
@section('content')

<div class="grid max-w-screen-xl px-4 pb-8 mx-auto mt-16">
    <div class="grid col-span-full">
        <h1 class="mt-8 mb-4">{{ __('messages.tasks') }}</h1>
            @include('flash::message')
        @auth
        <div class="mt-6">
        <form method="GET" action="{{route('tasks.create')}}">
            <x-primary-button>
                {{ __('messages.createTask') }}
            </x-primary-button>
        </form>
        </div>
        @endauth
            <table class="mt-4">
                <thead>
                    <tr class="border-b-2 border-solid border-black text-left">
                        <th style="text-align: left;">ID</th>
                        <th style="text-align: left;">{{ __('messages.taskStatus') }}</th>
                        <th style="text-align: left;">{{ __('messages.taskName') }}</th>
                        <th style="text-align: left;">{{ __('messages.taskAuthor') }}</th>
                        <th style="text-align: left;">{{ __('messages.taskExecutor') }}</th>
                        <th style="text-align: left;">{{ __('messages.taskCreatedAt') }}</th>
                        @auth
                        <th style="text-align: left;">{{ __('messages.taskActions') }}</th>
                        @endauth
                    </tr>
                </thead>
                    <tbody>
                    @foreach ($tasks as $task)
                    <tr class="border-b border-dashed text-left">
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->status->name }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->created_by->name }}</td>
                        <td>{{ $task->assigned_to->name }}</td>
                        <td>{{ date_format($task->created_at,"d-m-Y") }}</td>
                        @auth
                        <td>
                            <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:text-blue-700">
                                {{ __('messages.taskEdit') }}
                            </a>
                            | 
                            <a href="{{ route('task_statuses.destroy', $task) }}" class="text-red-500 hover:text-red-700" data-confirm="{{ __('messages.areYouSure') }}" data-method="delete">
                                {{ __('messages.taskDelete') }}
                            </a>
                        </td>
                        @endauth
                    </tr>
                    @endforeach
                </tbody></table>
</div>
</div>
@endsection