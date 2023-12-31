@extends('layouts.app')
@section('content')
<div class="grid max-w-screen-xl px-4 pb-8 mx-auto mt-16">
    <h1 class="mt-8 mb-4">{{ __('messages.createTask') }}</h1>
    {{ Form::model($task, ['route' => 'tasks.store']) }}
    {{ Form::label('name', __('messages.taskName'), ['class' => 'block font-medium text-sm text-gray-700 mt-4']) }}
    {{ Form::text('name', '', [
        "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 max-w-7xl mx-left"
    ]) }}
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
    {{ Form::label('description', __('messages.taskDescription'), ['class' => 'block font-medium text-sm text-gray-700 mt-4']) }}
    {{ Form::textarea('description', '', [
        "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-16 block mt-1 max-w-7xl mx-left"
    ]) }}
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
    <br>
    {{ Form::label('status_id', __('messages.taskStatus'), ['class' => 'block font-medium text-sm text-gray-700 mt-4']) }}
    {{ Form::select('status_id', $statusesArray, null, [
        "placeholder" => "-------",
        "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-12 block mt-1 max-w-7xl mx-left"
        ]) }}
        <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
    <br>
    {{ Form::label('assigned_to_id', __('messages.taskExecutor'), ['class' => 'block font-medium text-sm text-gray-700 mt-4']) }}
    {{ Form::select('assigned_to_id', $usersArray, null, [
        "placeholder" => "-------",
        "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-12 block mt-1 max-w-7xl mx-left"
        ]) }}
        <x-input-error :messages="$errors->get('assigned_to_id')" class="mt-2" />
    <br>
    {{ Form::label('labels', __('messages.labels'), ['class' => 'block font-medium text-sm text-gray-700 mt-4']) }}
    {{ Form::select('labels[]', $labelsArray, null, [
        "multiple" => "multiple",
        "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-32 block mt-1 max-w-7xl mx-left"
        ]) }}
        <x-input-error :messages="$errors->get('labels')" class="mt-2" />
    <br>
    {{ Form::submit(__('messages.createButton'), ['class'=>'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md text-white font-semibold hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4']) }}
    {{ Form::close() }}
</div>
@endsection