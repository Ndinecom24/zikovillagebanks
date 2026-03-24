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
        'stage_id',
        'order_number',
        'title',
        'description',
        'max_days',
        'status',
        'created_by',
    ];

    protected $casts = [
        'order_number' => 'integer',
        'max_days'     => 'integer',
    ];

    /* ── Relationships ────────────────── */

    public function stage()
    {
        return $this->belongsTo(ProcessStage::class, 'stage_id');
    }

    /**
     * @deprecated Use stage() instead.
     */
    public function module()
    {
        return $this->stage();
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

    /**
     * Human-readable duration label, e.g. "14 days".
     */
    public function getMaxDaysLabelAttribute(): string
    {
        if (!$this->max_days) return '—';
        return $this->max_days . ' ' . ($this->max_days === 1 ? 'day' : 'days');
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'active'      => '#10b981',
            'not_active'  => '#3b82f6',
            'pending'     => '#f59e0b',
            default       => '#6b7280',
        };
    }
}
