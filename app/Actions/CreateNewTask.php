<?php

namespace App\Actions;

use App\Models\Task;
use Illuminate\Http\Request;

class CreateNewTask
{
    /**
     * Create a new task - май инглиш из нот соу гууд
     * @param Request $request
     * @throws \Exception
     * @return Task
     */
    public function execute(Request $request): Task
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:in_progress,completed',
        ]);
        
        if (Task::where('title', $validated['title'])->exists()) {
            throw new \Exception('Такой таск уже существует');
        }

        return Task::create($validated);
    }
}
