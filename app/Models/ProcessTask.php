<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessTask extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'process_tasks';

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'priority',
        'due_date',
        'status',
        'created_by',
    ];

    protected $casts = [
        'due_date' => 'date:Y-m-d',
    ];

    /* ── Relationships ────────────────── */

    public function module()
    {
        return $this->belongsTo(ProcessModule::class, 'module_id');
    }

    public function offices()
    {
        return $this->belongsToMany(ResponsibleOffices::class, 'office_task', 'task_id', 'office_id')
            ->withPivot('status', 'remarks', 'assigned_at')
            ->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /* ── Helpers ──────────────────────── */

    public function getIsOverdueAttribute(): bool
    {
        if (!$this->due_date) return false;
        return $this->due_date->isPast() && $this->status !== 'completed';
    }

    public function getPriorityColorAttribute(): string
    {
        return match ($this->priority) {
            'high'   => '#dc2626',
            'medium' => '#f59e0b',
            'low'    => '#10b981',
            default  => '#6b7280',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'completed'   => '#10b981',
            'in_progress' => '#3b82f6',
            'pending'     => '#f59e0b',
            default       => '#6b7280',
        };
    }
}
