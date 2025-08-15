<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateNewTask;
use App\Actions\DeleteTask;
use App\Actions\UpdateOldTask;
use App\Exceptions\CreateNewTaskException;
use App\Exceptions\DeleteTaskException;
use App\Exceptions\UpdateOldTaskException;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function list(): JsonResponse
    {
        return response()->json([
            'data' => Task::all()
        ]);
    }

    public function view(int $id): JsonResponse
    {
        return response()->json([
            'data' => Task::find($id)
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        try {
            return response()->json([
                'message' => 'Таск успешно создан',
                'data' => (new CreateNewTask())
                    ->execute($request)
                    ->toArray()
            ], 201);
        } catch (CreateNewTaskException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            return response()->json([
                'message' => 'Таск успешно обновлён',
                'data' => (new UpdateOldTask())
                    ->execute($request, $id)
                    ->toArray()
            ]);
        } catch (UpdateOldTaskException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            (new DeleteTask())->execute($id);

            return response()->json([
                'message' => 'Таск успешно удалён'
            ]);
        } catch (DeleteTaskException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
