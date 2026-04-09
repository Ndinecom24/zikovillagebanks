<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleAcknowledgement extends Model
{
    use HasFactory;

    protected $table = 'rule_acknowledgements';

    protected $fillable = [
        'rule_id',
        'user_id',
        'acknowledged_at',
    ];

    protected $casts = [
        'acknowledged_at' => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function rule()
    {
        return $this->belongsTo(Rule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
