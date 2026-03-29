<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskService
{
    public function createTask(array $data): Task
    {
        // Validate no duplicate title on the same due_date
        $exists = Task::where('title', $data['title'])
            ->where('due_date', $data['due_date'])
            ->exists();

        if ($exists) {
            throw new \Exception('A task with this title already exists on the same due date.');
        }

        // Validate due_date must be today or in the future
        $dueDate = Carbon::parse($data['due_date']);
        if ($dueDate->lt(Carbon::today())) {
            throw new \Exception('Due date must be today or in the future.');
        }

        return Task::create($data);
    }

    public function listTasks(array $filters = []): Collection
    {
        $query = Task::query();

        // Filter by status
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        // Filter by priority
        if (isset($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        // Sort by priority (high → medium → low), then due_date ascending
        $query->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
              ->orderBy('due_date', 'asc');

        return $query->get();
    }

    public function updateStatus(Task $task): Task
    {
        $nextStatus = $task->getNextStatus();

        if ($nextStatus === null) {
            throw new \Exception('Task is already in final status.');
        }

        $task->status = $nextStatus;
        $task->save();

        return $task;
    }

    public function deleteTask(Task $task): void
    {
        if ($task->status !== 'done') {
            throw new \Exception('Only tasks with status "done" can be deleted.', 403);
        }

        $task->delete();
    }

    public function getDailyReport(string $date): array
    {
        $tasks = Task::whereDate('due_date', $date)->get();

        $summary = [
            'high' => ['pending' => 0, 'in_progress' => 0, 'done' => 0],
            'medium' => ['pending' => 0, 'in_progress' => 0, 'done' => 0],
            'low' => ['pending' => 0, 'in_progress' => 0, 'done' => 0],
        ];

        foreach ($tasks as $task) {
            $summary[$task->priority][$task->status]++;
        }

        return [
            'date' => $date,
            'summary' => $summary,
        ];
    }

    public function getOverdueTasks(): Collection
    {
        $today = Carbon::now('UTC')->format('Y-m-d');
        
        return Task::whereRaw('DATE(due_date) < ?', [$today])
            ->where('status', '!=', 'done')
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->orderBy('due_date', 'asc')
            ->get();
    }
}
