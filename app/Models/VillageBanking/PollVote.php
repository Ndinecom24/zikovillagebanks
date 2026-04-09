<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    use HasFactory;

    protected $table = 'poll_votes';

    protected $fillable = [
        'poll_id',
        'poll_option_id',
        'user_id',
    ];

    /* ── Relationships ────────────────── */

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function option()
    {
        return $this->belongsTo(PollOption::class, 'poll_option_id');
    }

    public function voter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
