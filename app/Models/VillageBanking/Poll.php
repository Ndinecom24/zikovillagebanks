<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'direct';

    protected $table = 'polls';

    protected $fillable = [
        'village_bank_id',
        'question',
        'description',
        'type',
        'is_anonymous',
        'status',
        'starts_at',
        'ends_at',
        'created_by',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'starts_at'    => 'datetime',
        'ends_at'      => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function options()
    {
        return $this->hasMany(PollOption::class)->orderBy('sort_order');
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    public function comments()
    {
        return $this->hasMany(PollComment::class)->orderBy('created_at');
    }

    /* ── Helpers ──────────────────────── */

    public function totalVoters(): int
    {
        return $this->votes()->distinct('user_id')->count('user_id');
    }

    public function totalVotes(): int
    {
        return $this->votes()->count();
    }

    public function hasVoted($userId): bool
    {
        return $this->votes()->where('user_id', $userId)->exists();
    }

    public function userVotes($userId)
    {
        return $this->votes()->where('user_id', $userId)->pluck('poll_option_id');
    }

    public function isOpen(): bool
    {
        if ($this->status !== 'active') {
            return false;
        }

        $now = now();
        if ($this->starts_at && $now->lt($this->starts_at)) {
            return false;
        }
        if ($this->ends_at && $now->gt($this->ends_at)) {
            return false;
        }

        return true;
    }

    public function participationRate(): float
    {
        $totalMembers = $this->villageBank->members()->count();
        if ($totalMembers === 0) return 0;

        return round(($this->totalVoters() / $totalMembers) * 100, 1);
    }
}
