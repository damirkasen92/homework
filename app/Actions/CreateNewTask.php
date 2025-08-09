<?php

namespace App\Actions;

use App\Exceptions\CreateNewTaskException;
use App\Models\Task;
use Illuminate\Http\Request;

class CreateNewTask
{
    /**
     * Create a new task - май инглиш из нот соу гууд
     * @param Request $request
     * @throws CreateNewTaskException
     * @return Task
     */
    public function execute(Request $request): Task
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:in_progress',
        ], [
            'status.in' => 'Статус может быть только "in_progress"', // подумал при создании нужен только "in_progress"
        ]);

        if (Task::where('title', $validated['title'])->exists()) {
            throw new CreateNewTaskException('Такой таск уже существует');
        }

        return Task::create($validated);
    }
}
