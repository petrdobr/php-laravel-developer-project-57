@extends('layouts.app')
@section('content')

<div class="grid max-w-screen-xl px-4 pb-8 mx-auto mt-16">
    <div class="grid col-span-full">
        <h1 class="mt-8 mb-4">{{ __('messages.taskStatuses') }}</h1>
        <div class="flex w-40 justify-start">
            @include('flash::message')
    </div>
        @auth
        <div class="mt-6">
            <x-primary-button>
                <a href="{{ route('task_statuses.create') }}">{{ __('messages.createStatus') }}</a>  
            </x-primary-button>
        </div>
        @endauth
            <table class="mt-4">
                <thead>
                    <tr class="border-b-2 border-solid border-black text-left">
                        <th style="text-align: left;">ID</th>
                        <th style="text-align: left;">{{ __('messages.statusName') }}</th>
                        <th style="text-align: left;">{{ __('messages.statusCreatedAt') }}</th>
                        @auth
                        <th style="text-align: left;">{{ __('messages.statusActions') }}</th>
                        @endauth
                    </tr>
                </thead>
                    <tbody>
                    @foreach ($taskStatuses as $status)
                    <tr class="border-b border-dashed text-left">
                        <td>{{ $status->id }}</td>
                        <td>{{ $status->name }}</td>
                        <td>{{ date_format($status->created_at,"d.m.Y") }}</td>
                        @auth
                        <td>
                            <a href="{{ route('task_statuses.edit', $status) }}" class="text-blue-500 hover:text-blue-700">
                                {{ __('messages.statusEdit') }}
                            </a>
                            | 
                            <a href="{{ route('task_statuses.destroy', $status) }}" class="text-red-500 hover:text-red-700" data-confirm="{{ __('messages.areYouSure') }}" data-method="delete">
                                {{ __('messages.statusDelete') }}
                            </a>
                        </td>
                        @endauth
                    </tr>
                    @endforeach
                </tbody></table>
</div>
</div>
@endsection
