
<form method="POST" action="{{ route('task_statuses.store') }}">
    @csrf
<div>
    <x-input-label :value="__('Status Name')" />
    <x-text-input id="name" class="block mt-1 w-full" name="name" />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>
<div class="flex items-center justify-end mt-4">
<x-primary-button class="ms-3">
    {{ __('Create') }}
</x-primary-button>
</div>
</form>