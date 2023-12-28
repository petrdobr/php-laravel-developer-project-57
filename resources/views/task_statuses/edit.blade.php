@extends('layouts.app')
@section('content')
<div class="grid max-w-screen-xl px-4 pb-8 mx-auto mt-16">
    <h1 class="mt-8 mb-4">{{ __('messages.editStatus') }}</h1>
<form method="POST" action="{{ route('task_statuses.update', $taskStatus) }}">
    @csrf
    @method('PATCH')
    <x-input-label :value="__('messages.taskName')" class="mt-4" />
    <x-text-input id="name" name="name" class="block mt-1 max-w-7xl mx-left" value="{{ $taskStatus->name }}" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
<x-primary-button class="mt-4">
    {{ __('messages.updateButton') }}
</x-primary-button>
</form>
    @endsection