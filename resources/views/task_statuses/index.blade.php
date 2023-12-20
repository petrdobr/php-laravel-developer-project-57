@extends('layouts.app')
@section('content')
@auth
<div class="sm:flex sm:top-0 sm:right-0 p-6 text-right">
<form method="GET" action="{{route('task_statuses.create')}}">
    <x-primary-button>
        {{ __('CREATE') }}
    </x-primary-button>
</form>
</div>
@endauth
<div class="grid col-span-full p-6">
    <h1 class="mb-5">Статусы</h1>
    <table class="mt-4">
        <thead>
            <tr class="border-b-2 border-solid border-black">
                <th>ID</th>
                <th>Имя</th>
                <th>Дата создания</th>
                @auth
                <th>Действия</th>
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
                    <a href="{{ route('task_statuses.edit', $status) }}">Edit</a>
                </td>
                @endauth
            </tr>
            @endforeach
        </tbody></table>
</div>
@endsection