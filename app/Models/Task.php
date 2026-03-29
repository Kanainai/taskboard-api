<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'due_date',
        'priority',
        'status',
        'assigned_to',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function getNextStatus(): ?string
    {
        return match ($this->status) {
            'pending' => 'in_progress',
            'in_progress' => 'done',
            'done' => null,
            default => null,
        };
    }
}
