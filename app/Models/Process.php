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

    public function modules()
    {
        return $this->hasMany(ProcessModule::class, 'process_id')->orderBy('order');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /* ── Helpers ──────────────────────── */

    public function totalTaskCount(): int
    {
        return ProcessTask::whereIn('module_id', $this->modules()->pluck('id'))->count();
    }

    public function completedTaskCount(): int
    {
        return ProcessTask::whereIn('module_id', $this->modules()->pluck('id'))
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
