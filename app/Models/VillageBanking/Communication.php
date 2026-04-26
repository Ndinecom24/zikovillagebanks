<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    protected $table = 'communications';

    protected $fillable = [
        'village_bank_id',
        'channel',
        'subject',
        'message',
        'recipient_type',
        'recipient_ids',
        'total_recipients',
        'sent_count',
        'failed_count',
        'status',
        'sent_by',
        'sent_at',
    ];

    protected $casts = [
        'recipient_ids' => 'array',
        'sent_at'       => 'datetime',
    ];

    /* ── Relationships ── */

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }

    /* ── Scopes ── */

    public function scopeForBank($query, int $bankId)
    {
        return $query->where('village_bank_id', $bankId);
    }

    public function scopeEmails($query)
    {
        return $query->where('channel', 'email');
    }

    public function scopeSms($query)
    {
        return $query->where('channel', 'sms');
    }

    /* ── Helpers ── */

    public function isFullySent(): bool
    {
        return $this->status === 'sent' && $this->failed_count === 0;
    }

    public function hasFailures(): bool
    {
        return $this->failed_count > 0;
    }
}
