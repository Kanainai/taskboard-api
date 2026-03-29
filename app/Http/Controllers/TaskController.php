<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'due_date' => 'required|date|after_or_equal:today',
            'priority' => 'required|in:low,medium,high',
            'assigned_to' => 'nullable|string',
        ]);

        try {
            $task = $this->taskService->createTask($validated);
            return response()->json($task, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['status', 'priority']);
        $tasks = $this->taskService->listTasks($filters);

        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'No tasks found', 'tasks' => []], 200);
        }

        return response()->json($tasks, 200);
    }

    public function updateStatus(int $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        try {
            $task = $this->taskService->updateStatus($task);
            return response()->json($task, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        try {
            $this->taskService->deleteTask($task);
            return response()->json(null, 204);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() === 403 ? 403 : 422;
            return response()->json(['error' => $e->getMessage()], $statusCode);
        }
    }

    public function report(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'date' => 'required|date_format:Y-m-d',
        ]);

        $report = $this->taskService->getDailyReport($validated['date']);
        return response()->json($report, 200);
    }

    public function overdue(): JsonResponse
    {
        $tasks = $this->taskService->getOverdueTasks();
        return response()->json($tasks, 200);
    }
}
