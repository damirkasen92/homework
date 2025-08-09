<?php

namespace App\Actions;

use App\Models\Task;
use Illuminate\Http\Request;

class UpdateOldTask
{
    /**
     * Update an existing task
     * @param Request $request
     * @param integer $taskId
     * @throws \Exception
     * @return Task
     */
    public function execute(Request $request, int $taskId): Task
    {
        $task = Task::find($taskId);

        if (!$task) {
            throw new \Exception('Такой таск не найден');
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:in_progress,completed',
        ]);

        $task->update($validated);

        return $task;
    }
}
