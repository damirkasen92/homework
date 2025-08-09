<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreateNewTask;
use App\Actions\DeleteTask;
use App\Actions\UpdateOldTask;
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
        //валидация в action, или же сервисы нужны были. Каждый по своему говорит, не знаю какая практика лучше
        //или отдельный класс для валидации, но вроде бы приложение простое. Эх еще учиться и учиться
        try {
            return response()->json([
                'message' => 'Таск успешно создан',
                'data' => (new CreateNewTask())
                    ->execute($request)
                    ->toArray() // Преобразуем модель в массив, скажем нет неявности))
            ], 201);
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
