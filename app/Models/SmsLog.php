<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $table = 'sms_logs';

    protected $fillable = [
        'recipient',
        'message',
        'sender_address',
        'service_code',
        'correlation_id',
        'transaction_id',
        'status_code',
        'status_message',
        'status',
        'sent_by',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /* ── Relationships ── */

    public function sender()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }

    /* ── Scopes ── */

    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopeRecent($query, int $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}
