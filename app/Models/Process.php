<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'processes';

    protected $fillable = [
        'name',
        'description',
        'status',
        'created_by',
    ];

    /* ── Relationships ────────────────── */

    public function stages()
    {
        return $this->hasMany(ProcessStage::class, 'process_id')->orderBy('order');
    }

    /**
     * @deprecated Use stages() instead.
     */
    public function modules()
    {
        return $this->stages();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function clientProcesses()
    {
        return $this->hasMany(ClientProcess::class, 'process_id');
    }

    /* ── Helpers ──────────────────────── */

    public function totalTaskCount(): int
    {
        return ProcessTask::whereIn('stage_id', $this->stages()->pluck('id'))->count();
    }

    public function completedTaskCount(): int
    {
        return ProcessTask::whereIn('stage_id', $this->stages()->pluck('id'))
            ->where('status', 'completed')
            ->count();
    }

    public function getProgressAttribute(): int
    {
        $total = $this->totalTaskCount();
        if ($total === 0) return 0;
        return (int) round(($this->completedTaskCount() / $total) * 100);
    }
}
