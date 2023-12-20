@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('task_statuses.update', $taskStatus) }}">
    @csrf
    @method('PATCH')
<div class="p-6">
    <x-input-label :value="__('Status Name')" />
    <x-text-input id="name" class="block mt-1 max-w-7xl mx-left" value="{{ $taskStatus->name }}" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
<br>
<x-primary-button>
    {{ __('Update') }}
</x-primary-button>
</form>

<form method="POST" action="{{ route('task_statuses.destroy', $taskStatus) }}">
    @csrf
    @method('DELETE')
    <x-primary-button>
        {{ __('Delete') }}
    </x-primary-button>
    </form>
</div>
    @endsection