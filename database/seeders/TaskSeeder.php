<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $assignees = ['Alice', 'Bob', 'Charlie', 'Diana', 'Eve', null];
        
        $tasks = [
            ['title' => 'Design homepage', 'due_date' => Carbon::today()->addDays(5), 'priority' => 'high', 'status' => 'pending', 'assigned_to' => 'Alice'],
            ['title' => 'Fix login bug', 'due_date' => Carbon::today()->addDays(2), 'priority' => 'high', 'status' => 'in_progress', 'assigned_to' => 'Bob'],
            ['title' => 'Write unit tests', 'due_date' => Carbon::today()->addDays(7), 'priority' => 'medium', 'status' => 'pending', 'assigned_to' => 'Charlie'],
            ['title' => 'Update documentation', 'due_date' => Carbon::today()->addDays(10), 'priority' => 'low', 'status' => 'pending', 'assigned_to' => 'Diana'],
            ['title' => 'Code review PR #123', 'due_date' => Carbon::today()->addDays(1), 'priority' => 'high', 'status' => 'pending', 'assigned_to' => 'Eve'],
            ['title' => 'Refactor authentication', 'due_date' => Carbon::today()->addDays(14), 'priority' => 'medium', 'status' => 'pending', 'assigned_to' => 'Alice'],
            ['title' => 'Setup CI/CD pipeline', 'due_date' => Carbon::today()->addDays(3), 'priority' => 'high', 'status' => 'in_progress', 'assigned_to' => 'Bob'],
            ['title' => 'Database optimization', 'due_date' => Carbon::today()->addDays(8), 'priority' => 'medium', 'status' => 'pending', 'assigned_to' => 'Charlie'],
            ['title' => 'Update dependencies', 'due_date' => Carbon::today()->subDays(2), 'priority' => 'low', 'status' => 'pending', 'assigned_to' => null],
            ['title' => 'Security audit', 'due_date' => Carbon::today()->addDays(6), 'priority' => 'high', 'status' => 'pending', 'assigned_to' => 'Diana'],
            ['title' => 'Mobile responsive fixes', 'due_date' => Carbon::today()->subDays(1), 'priority' => 'medium', 'status' => 'in_progress', 'assigned_to' => 'Eve'],
            ['title' => 'API documentation', 'due_date' => Carbon::today()->addDays(12), 'priority' => 'low', 'status' => 'done', 'assigned_to' => 'Alice'],
            ['title' => 'Performance testing', 'due_date' => Carbon::today()->addDays(4), 'priority' => 'medium', 'status' => 'pending', 'assigned_to' => 'Bob'],
            ['title' => 'User feedback analysis', 'due_date' => Carbon::today()->addDays(9), 'priority' => 'low', 'status' => 'done', 'assigned_to' => 'Charlie'],
            ['title' => 'Deploy to staging', 'due_date' => Carbon::today(), 'priority' => 'high', 'status' => 'in_progress', 'assigned_to' => 'Diana'],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
