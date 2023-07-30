@extends('layouts.base')

@section('main')
@if (isset($task))

<p>
    <input type="checkbox"
        name="is_done"
        value="active"
        @checked(old('active', $task->is_done)) disabled/>
    Message: {{ $task->message }}
</p>
<p>Created: {{ $task->created_at }}</p>
<p>Updated: {{ $task->updated_at }}</p>

@endif
@endsection('main')