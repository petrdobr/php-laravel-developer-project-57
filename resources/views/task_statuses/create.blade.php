@extends('layouts.app')
@section('content')
<div class="grid max-w-screen-xl px-4 pb-8 mx-auto mt-16">
    <h1 class="mt-8 mb-4">{{ __('messages.createStatus') }}</h1>
<form method="POST" action="{{ route('task_statuses.store') }}">
    @csrf
    <x-input-label :value="__('messages.statusName')" class="mt-4" />
    <x-text-input id="name" class="block mt-1 max-w-7xl mx-left" name="name" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
<x-primary-button class="mt-4">
    {{ __('messages.createButton') }}
</x-primary-button>
</form>
</div>
@endsection