@extends('layouts.app')
@section('content')

<div class="grid max-w-screen-xl px-4 pb-8 mx-auto mt-16">
    <div class="grid col-span-full">
        <h1 class="mt-8 mb-4">{{ __('messages.tasks') }}</h1>
        <div class="flex w-40 justify-start">
            @include('flash::message')
        </div>
        @auth
        <div class="mt-6">
        <form method="GET" action="{{route('tasks.create')}}">
            <x-primary-button>
                {{ __('messages.createTask') }}
            </x-primary-button>
        </form>
        </div>
        @endauth

        {{ Form::model($tasks, ['route' => 'tasks.index', 'method' => 'GET']) }}
        <div class="flex">
        {{ Form::select('filter[status_id]', $statusesArray, $lastChoise['status_id'], [
            "placeholder" => __('messages.taskStatus'),
            "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-12 block max-w-7xl mx-left"
            ]) }}
        {{ Form::select('filter[created_by_id]', $usersArray, $lastChoise['created_by_id'], [
            "placeholder" => __('messages.taskAuthor'),
            "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-12 block max-w-7xl mx-left"
            ]) }}
        {{ Form::select('filter[assigned_to_id]', $usersArray, $lastChoise['assigned_to_id'], [
            "placeholder" => __('messages.taskExecutor'),
            "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-12 block max-w-7xl mx-left"
            ]) }}
        {{ Form::submit(__('messages.applyButton'), ['class'=>'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}
        </div>
        {{ Form::close() }}
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
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                {{ $task->name }}
                            </a>
                        </td>
                        <td>{{ $task->created_by->name }}</td>
                        <td>{{ $task->assigned_to->name }}</td>
                        <td>{{ date_format($task->created_at,"d-m-Y") }}</td>
                        @auth
                        <td>
                            <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 hover:text-blue-700">
                                {{ __('messages.taskEdit') }}
                            </a>
                            @can('delete-task', $task)
                            | 
                            <a href="{{ route('tasks.destroy', $task) }}" class="text-red-500 hover:text-red-700" data-confirm="{{ __('messages.areYouSure') }}" data-method="delete">
                                {{ __('messages.taskDelete') }}
                            </a>
                            @endcan
                        </td>
                        @endauth
                    </tr>
                    @endforeach
                </tbody></table>
                <div class="mt-2">
                    {{ $tasks->links() }}
                </div>
</div>
</div>
@endsection
