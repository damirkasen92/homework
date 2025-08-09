<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(TaskController::class)
    ->group(function () {
        Route::get('/tasks', 'list');
        
        Route::get('/tasks/{id}', 'view')
            ->where('id', '[0-9]+');

        Route::post('/tasks', 'create');

        Route::put('/tasks/{id}', 'update')
            ->where('id', '[0-9]+');

        Route::delete('/tasks/{id}', 'delete')
            ->where('id', '[0-9]+');
    });
