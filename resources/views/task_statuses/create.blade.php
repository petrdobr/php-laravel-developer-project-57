@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('task_statuses.store') }}">
    @csrf
<div class="p-6">
    <x-input-label :value="__('Status Name')" />
    <x-text-input id="name" class="block mt-1 max-w-7xl mx-left" name="name" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <br>
<x-primary-button>
    {{ __('Create') }}
</x-primary-button>
</form>
</div>
@endsection