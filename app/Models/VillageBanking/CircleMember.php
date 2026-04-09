<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CircleMember extends Pivot
{
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'circle';
    protected $table = 'circle_members';

    public $incrementing = true;

    protected $casts = [
        'joined_at' => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
