<?php

namespace App\Models\VillageBanking;

use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'month';
    public string $villageBankScopeColumn = 'month_id';

    protected $table = 'phases';

    protected $fillable = [
        'month_id',
        'name',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function month()
    {
        return $this->belongsTo(Month::class);
    }
}
