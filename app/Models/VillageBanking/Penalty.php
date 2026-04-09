<?php

namespace App\Models\VillageBanking;

use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'loan';

    protected $table = 'penalties';

    public $timestamps = false;

    protected $fillable = [
        'loan_id',
        'percentage',
        'amount',
        'applied_at',
    ];

    protected $casts = [
        'percentage' => 'decimal:2',
        'amount'     => 'decimal:2',
        'applied_at' => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
