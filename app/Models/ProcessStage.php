<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcessStage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'process_stages';

    protected $fillable = [
        'process_id',
        'name',
        'description',
        'order',
        'status',
    ];

    /* ── Relationships ────────────────── */

    public function process()
    {
        return $this->belongsTo(Process::class, 'process_id');
    }

    public function tasks()
    {
        return $this->hasMany(ProcessTask::class, 'stage_id')->orderBy('order_number');
    }

    /* ── Helpers ──────────────────────── */

    public function completedTaskCount(): int
    {
        return $this->tasks()->where('status', 'completed')->count();
    }

    public function getProgressAttribute(): int
    {
        $total = $this->tasks()->count();
        if ($total === 0) return 0;
        return (int) round(($this->completedTaskCount() / $total) * 100);
    }
}
