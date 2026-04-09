<?php

namespace App\Models\VillageBanking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    use HasFactory;

    protected $table = 'poll_options';

    protected $fillable = [
        'poll_id',
        'label',
        'sort_order',
    ];

    /* ── Relationships ────────────────── */

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    /* ── Helpers ──────────────────────── */

    public function voteCount(): int
    {
        return $this->votes()->count();
    }

    public function percentage(): float
    {
        $total = $this->poll->totalVotes();
        if ($total === 0) return 0;

        return round(($this->voteCount() / $total) * 100, 1);
    }
}
