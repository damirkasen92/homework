<?php

namespace App\Actions;

use App\Exceptions\UpdateOldTaskException;
use App\Models\Task;
use Illuminate\Http\Request;

class UpdateOldTask
{
    /**
     * Update an existing task
     * @param Request $request
     * @param integer $taskId
     * @throws UpdateOldTaskException
     * @return Task
     */
    public function execute(Request $request, int $taskId): Task
    {
        $task = Task::find($taskId);

        if (!$task) {
            throw new UpdateOldTaskException('Такой таск не найден');
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255|unique:tasks,title,' . $taskId,
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:in_progress,completed',
        ], [
            'title.unique' => 'Заголовок должен быть уникальным', // тут я тоже подумал, что заголовок должен быть уникальным
        ]);

        $task->update($validated);

        return $task;
    }
}
