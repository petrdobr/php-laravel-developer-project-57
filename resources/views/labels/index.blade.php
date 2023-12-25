@extends('layouts.app')
@section('content')

<div class="grid max-w-screen-xl px-4 pb-8 mx-auto mt-16">
    <div class="grid col-span-full">
        <h1 class="mt-8 mb-4">{{ __('messages.labels') }}</h1>
        <div class="flex w-40 justify-start">
            @include('flash::message')
    </div>
        @auth
        <div class="mt-6">
        <form method="GET" action="{{route('labels.create')}}">
            <x-primary-button>
                {{ __('messages.createLabel') }}
            </x-primary-button>
        </form>
        </div>
        @endauth
            <table class="mt-4">
                <thead>
                    <tr class="border-b-2 border-solid border-black text-left">
                        <th style="text-align: left;">ID</th>
                        <th style="text-align: left;">{{ __('messages.labelName') }}</th>
                        <th style="text-align: left;">{{ __('messages.labelDescription') }}</th>
                        <th style="text-align: left;">{{ __('messages.labelCreatedAt') }}</th>
                        @auth
                        <th style="text-align: left;">{{ __('messages.labelActions') }}</th>
                        @endauth
                    </tr>
                </thead>
                    <tbody>
                    @foreach ($labels as $label)
                    <tr class="border-b border-dashed text-left">
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->description }}</td>
                        <td>{{ date_format($label->created_at,"d-m-Y") }}</td>
                        @auth
                        <td>
                            <a href="{{ route('labels.edit', $label) }}" class="text-blue-500 hover:text-blue-700">
                                {{ __('messages.statusEdit') }}
                            </a>
                            | 
                            <a href="{{ route('labels.destroy', $label) }}" class="text-red-500 hover:text-red-700" data-confirm="{{ __('messages.areYouSure') }}" data-method="delete">
                                {{ __('messages.statusDelete') }}
                            </a>
                        </td>
                        @endauth
                    </tr>
                    @endforeach
                </tbody></table>
</div>
</div>
@endsection
