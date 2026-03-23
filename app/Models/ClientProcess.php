<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientProcess extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'client_process';

    protected $fillable = [
        'client_id',
        'process_id',
        'status',
        'started_at',
        'completed_at',
        'started_by',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function client()
    {
        return $this->belongsTo(ClientDetails::class, 'client_id');
    }

    public function process()
    {
        return $this->belongsTo(Process::class, 'process_id');
    }

    public function starter()
    {
        return $this->belongsTo(User::class, 'started_by');
    }

    public function taskProgress()
    {
        return $this->hasMany(ClientTaskProgress::class, 'client_process_id');
    }

    /* ── Helpers ──────────────────────── */

    public function totalTasks(): int
    {
        return $this->taskProgress()->count();
    }

    public function completedTasks(): int
    {
        return $this->taskProgress()->where('status', 'completed')->count();
    }

    public function getProgressAttribute(): int
    {
        $total = $this->totalTasks();
        if ($total === 0) return 0;
        return (int) round(($this->completedTasks() / $total) * 100);
    }

    public function getCurrentModuleAttribute()
    {
        // Find the first module that has incomplete tasks
        $firstIncomplete = $this->taskProgress()
            ->where('status', '!=', 'completed')
            ->with('processTask.module')
            ->orderBy('id')
            ->first();

        return $firstIncomplete?->processTask?->module;
    }
}
