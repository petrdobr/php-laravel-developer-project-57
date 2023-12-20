@extends('layouts.app')
@section('content')

<div class="grid col-span-full p-6">
    <h1 class="mb-5">{{ __('messages.taskStatuses') }}</h1>
    @auth
<div class="sm:flex sm:top-0 sm:right-0 p-6 text-right">
<form method="GET" action="{{route('task_statuses.create')}}">
    <x-primary-button>
        {{ __('messages.createStatus') }}
    </x-primary-button>
</form>
</div>
@endauth
    <table class="mt-4">
        <thead>
            <tr class="border-b-2 border-solid border-black">
                <th>ID</th>
                <th>{{ __('messages.statusName') }}</th>
                <th>{{ __('messages.statusCreatedAt') }}</th>
                @auth
                <th>{{ __('messages.statusActions') }}</th>
                @endauth
            </tr>
        </thead>
            <tbody>
            @foreach ($taskStatuses as $status)
            <tr class="border-b border-dashed">
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>{{ date_format($status->created_at,"d-m-Y") }}</td>
                @auth
                <td>
                    <a href="{{ route('task_statuses.edit', $status) }}" class="text-blue-500 hover:text-blue-700">{{ __('messages.statusEdit') }}</a>
                     | 
                    <a href="{{ route('task_statuses.edit', $status) }}" class="text-red-500 hover:text-red-700">{{ __('messages.statusDelete') }}</a>
                </td>
                @endauth
            </tr>
            @endforeach
        </tbody></table>
</div>
@endsection