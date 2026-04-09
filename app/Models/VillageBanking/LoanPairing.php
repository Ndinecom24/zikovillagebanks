<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPairing extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'loan';

    protected $table = 'loan_pairings';

    protected $fillable = [
        'loan_id',
        'lender_id',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /* ── Relationships ────────────────── */

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function lender()
    {
        return $this->belongsTo(User::class, 'lender_id');
    }
}
