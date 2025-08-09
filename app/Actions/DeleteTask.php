<?php

namespace App\Actions;

use App\Models\Task;

class DeleteTask
{
    /**
     * Delete a task
     * @param integer $taskId
     * @throws \Exception
     * @return void
     */
    public function execute(int $taskId): void
    {
        $task = Task::find($taskId);

        if (!$task) {
            throw new \Exception('Такой таск не найден');
        }

        $task->delete();
    }
}
