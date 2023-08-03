<x-base>
    <div class="mx-auto w-50 mt-5">
        @if (isset($task))

        <p>Status: {{ $task->is_done ? 'Done' : 'Not done' }}</p>
        <p>Message: {{ $task->message }}</p>
        <p>Created: {{ $task->created_at }}</p>
        <p>Updated: {{ $task->updated_at }}</p>
        <p>Author: {{ $task->user->name }}</p>

        @endif
    </div>
</x-base>
