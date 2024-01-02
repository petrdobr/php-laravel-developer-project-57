@extends('layouts.app')
@section('content')
<div class="grid max-w-screen-xl px-4 pb-8 mx-auto mt-16">
    <h1 class="mt-8 mb-4">{{ __('messages.createLabel') }}</h1>
{{ Form::model($label, ['route' => 'labels.store']) }}
{{ Form::label('name', __('messages.labelName'), ['class' => 'block font-medium text-sm text-gray-700 mt-4']) }}
{{ Form::text('name', '', [
    "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 max-w-7xl mx-left"
]) }}
<x-input-error :messages="$errors->get('name')" class="mt-2" />
{{ Form::label('description', __('messages.labelDescription'), ['class' => 'block font-medium text-sm text-gray-700 mt-4']) }}
{{ Form::textarea('description', '', [
    "class" => "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-16 block mt-1 max-w-7xl mx-left"
]) }}
{{ Form::submit(__('messages.createButton'), ['class'=>'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md text-white font-semibold hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4']) }}
{{ Form::close() }}
</div>
@endsection