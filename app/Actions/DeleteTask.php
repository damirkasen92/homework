<?php

namespace App\Actions;

use App\Exceptions\DeleteTaskException;
use App\Models\Task;

class DeleteTask
{
    /**
     * Delete a task
     * @param integer $taskId
     * @throws DeleteTaskException
     * @return void
     */
    public function execute(int $taskId): void
    {
        $task = Task::find($taskId);

        if (!$task) {
            throw new DeleteTaskException('Такой таск не найден');
        }

        $task->delete();
    }
}
