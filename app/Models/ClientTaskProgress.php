<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTaskProgress extends Model
{
    use HasFactory;

    protected $table = 'client_task_progress';

    protected $fillable = [
        'client_process_id',
        'process_task_id',
        'status',
        'remarks',
        'completed_by',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function clientProcess()
    {
        return $this->belongsTo(ClientProcess::class, 'client_process_id');
    }

    public function processTask()
    {
        return $this->belongsTo(ProcessTask::class, 'process_task_id');
    }

    public function completedByUser()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

    public function comments()
    {
        return $this->hasMany(ClientTaskComment::class, 'client_task_progress_id');
    }

    public function files()
    {
        return $this->hasMany(ClientTaskFile::class, 'client_task_progress_id');
    }
}
