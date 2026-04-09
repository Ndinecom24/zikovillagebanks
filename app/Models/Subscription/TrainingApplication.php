<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class TrainingApplication extends Model
{
    protected $table = 'training_applications';

    protected $fillable = [
        'training_program_id', 'full_name', 'email', 'phone',
        'village_bank', 'role_in_bank', 'motivation',
        'status', 'admin_notes', 'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    /* ── Relationships ────────────── */

    public function program()
    {
        return $this->belongsTo(TrainingProgram::class, 'training_program_id');
    }

    /* ── Scopes ───────────────────── */

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /* ── Helpers ──────────────────── */

    public function statusBadge(): string
    {
        $badges = [
            'pending'  => '<span class="badge bg-warning text-dark">Pending</span>',
            'approved' => '<span class="badge bg-success">Approved</span>',
            'rejected' => '<span class="badge bg-danger">Rejected</span>',
        ];
        return $badges[$this->status] ?? $this->status;
    }
}
