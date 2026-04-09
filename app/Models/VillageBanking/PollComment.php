<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollComment extends Model
{
    use HasFactory;

    protected $table = 'poll_comments';

    protected $fillable = [
        'poll_id',
        'user_id',
        'body',
    ];

    /* ── Relationships ────────────────── */

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
