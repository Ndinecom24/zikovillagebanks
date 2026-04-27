<?php

namespace App\Models\VillageBanking;

use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repayment extends Model
{
    use HasFactory;
    use ScopedToVillageBank;
    use SoftDeletes;

    public string $villageBankScopeTier = 'loan';

    protected $table = 'repayments';

    protected $fillable = [
        'loan_id',
        'amount_paid',
        'remaining_balance',
        'penalty_applied',
    ];

    protected $casts = [
        'amount_paid'       => 'decimal:2',
        'remaining_balance' => 'decimal:2',
        'penalty_applied'   => 'decimal:2',
    ];

    /* ── Relationships ────────────────── */

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
