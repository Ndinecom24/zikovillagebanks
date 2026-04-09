<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $fillable = [
        'log_type',
        'event',
        'description',
        'subject_type',
        'subject_id',
        'user_id',
        'user_name',
        'ip_address',
        'user_agent',
        'properties',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    /* ── Relationships ──────────────────── */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->morphTo();
    }

    /* ── Scopes ─────────────────────────── */

    public function scopeOfType($query, string $type)
    {
        return $query->where('log_type', $type);
    }

    public function scopeOfEvent($query, string $event)
    {
        return $query->where('event', $event);
    }

    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeRecent($query, int $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /* ── Helper: quick log ──────────────── */

    /**
     * Record an activity log entry.
     */
    public static function record(array $data): self
    {
        $user = auth()->user();

        return static::create(array_merge([
            'user_id'    => $user->id ?? null,
            'user_name'  => $user->name ?? 'System',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ], $data));
    }
}
