<?php

namespace App\Models\VillageBanking;

use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shareout extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'circle';

    protected $table = 'shareouts';

    protected $fillable = [
        'circle_id',
        'total_contributions',
        'total_interest',
        'total_penalties',
        'total_pool',
    ];

    protected $casts = [
        'total_contributions' => 'decimal:2',
        'total_interest'      => 'decimal:2',
        'total_penalties'     => 'decimal:2',
        'total_pool'          => 'decimal:2',
    ];

    /* ── Relationships ────────────────── */

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function allocations()
    {
        return $this->hasMany(ShareoutAllocation::class);
    }
}
