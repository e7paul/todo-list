@extends('layouts.base')

@section('main')

@if (count($tasks) > 0)
<table class="mx-auto table w-50">
    <thead>
        <tr>
            <th class="text-center">Status</th>
            <th class="text-center">Message</th>
            <th class="text-center">Created at</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($tasks as $task)
        <tr>
            <td>
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('patch')
                <input type="checkbox"
                    name="is_done"
                    value="1"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                    @checked($task->is_done)
                    class="form-check-input mt-0"
                    />
            </form>
            </td>
            <td>
                <p>
                    <span @if ($task->is_done) class="text-decoration-line-through" @endif>{{ $task->message }}</span>
                    @unless ($task->created_at->eq($task->updated_at))
                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                    @endunless
                </p>
                
            </td>
            <td>
                <p>{{ $task->created_at }}</p>
            </td>
            <td class="d-flex">
                <x-dropdown-link :href="route('tasks.edit', $task)">
                    {{ __('Edit') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                    @csrf
                    @method('delete')
                    <x-dropdown-link :href="route('tasks.destroy', $task)" onclick="event.preventDefault(); if (confirm('Remove task?')) {this.closest('form').submit();}">
                        {{ __('Delete') }}
                    </x-dropdown-link>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endif

<br>
<hr>

<div class="mx-auto mt-5 w-50">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <textarea
                name="message"
                placeholder="{{ __('Describe your task') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
        </form>
    </div>

@endsection('main')