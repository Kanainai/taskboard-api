<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Ping endpoint for API warmup
Route::get('/ping', function() {
    return response()->json(['status' => 'ok']);
});

// Report and overdue routes MUST come before {id} routes to avoid conflicts
Route::get('/tasks/report', [TaskController::class, 'report']);
Route::get('/tasks/overdue', [TaskController::class, 'overdue']);

// Task CRUD routes
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::patch('/tasks/{id}/status', [TaskController::class, 'updateStatus']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
