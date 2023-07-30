<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Cache::remember('index_' . Auth::user()->id, env('CACHE_LIFETIME', 10), function () {
            return Task::where('user_id', Auth::user()->id)->latest()->get();
        });
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function all(): View
    {
        $tasks = Cache::remember('tasks', env('CACHE_LIFETIME', 10), function () {
            return Task::with('user')->latest()->get();
        });
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function show(string $id): View
    {
        $tasks = Cache::remember('task_' . $id, env('CACHE_LIFETIME', 10), function () use ($id) {
            return Task::findOrFail($id);
        });
        return view('tasks.show', ['task' => $tasks]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $validated['is_done'] = false;
 
        $request->user()->tasks()->create($validated);

        Cache::forget('index_' . Auth::user()->id);

        return redirect(route('tasks.index'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
 
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);
 
        $validated = $request->validate([
            'message' => 'string|max:255'
        ]);

        $validated['is_done'] = $request->boolean('is_done');
 
        $task->update($validated);
        
        Cache::forget('index_' . Auth::user()->id);
 
        return redirect(route('tasks.index'));
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);
 
        $task->delete();
 
        Cache::forget('task' . $task->id);
        Cache::forget('index_' . Auth::user()->id);

        return redirect(route('tasks.index'));
    }
}
