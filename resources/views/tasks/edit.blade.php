<x-base>
    <div class="mx-auto w-50 mt-5">
        @if (isset($task))
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('patch')
            <textarea name="message" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message', $task->message) }}</textarea>
            <div class="form-check mt-2">
                <input type="checkbox" name="is_done" @checked($task->is_done)
                class="form-check-input"
                id="checkbox"
                />
                <label class="form-check-label" for="checkbox">
                    Is task done?
                </label>
            </div>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('tasks.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
        @endif
    </div>
</x-base>
