<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Ping endpoint for API warmup
Route::get('/ping', function() {
    return response()->json(['status' => 'ok']);
});

// Debug endpoint
Route::get('/debug/date', function() {
    $now = \Carbon\Carbon::now();
    $today = $now->toDateString();
    $task78 = \App\Models\Task::find(78);
    
    return response()->json([
        'server_now' => $now->toDateTimeString(),
        'server_today' => $today,
        'timezone' => config('app.timezone'),
        'task_78' => $task78 ? [
            'id' => $task78->id,
            'due_date' => $task78->due_date,
            'due_date_raw' => $task78->getAttributes()['due_date'],
            'status' => $task78->status,
            'is_overdue' => $task78->due_date < $now->toDateString(),
        ] : null,
    ]);
});

// Report and overdue routes MUST come before {id} routes to avoid conflicts
Route::get('/tasks/report', [TaskController::class, 'report']);
Route::get('/tasks/overdue', [TaskController::class, 'overdue']);

// Task CRUD routes
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::patch('/tasks/{id}/status', [TaskController::class, 'updateStatus']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
