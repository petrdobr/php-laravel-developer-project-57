@extends('layouts.app')
@section('content')
<div class="grid max-w-screen-xl px-4 pb-8 mx-auto mt-16">
    <h1 class="mt-8 mb-4">{{ __('messages.createTask') }}</h1>
<form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    <x-input-label :value="__('messages.taskName')" class="mt-4" />
    {{ Form::text('name', '', [
        "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 max-w-7xl mx-left"
    ]) }}
    <x-input-label :value="__('messages.taskDescription')" class="mt-4" />
    {{ Form::textarea('description', '', [
        "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-16 block mt-1 max-w-7xl mx-left"
    ]) }}<br>
    <x-input-label :value="__('messages.taskStatus')" class="mt-4" />
    {{ Form::select('status_id', $statusesArray, null, ['placeholder' => '-------']) }}
    <br>
    <x-input-label :value="__('messages.taskExecutor')" class="mt-4" />
    {{ Form::select('assigned_to_id', $usersArray, null, ['placeholder' => '-------']) }}
    <br>
    <x-primary-button class="mt-4">
    {{ __('messages.createButton') }}
</x-primary-button>
</form>
</div>
@endsection