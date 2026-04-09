<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Loan extends Model
{
    use HasFactory;
    use LogsActivity;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'month';

    protected $table = 'loans';

    protected $fillable = [
        'borrower_id',
        'month_id',
        'amount',
        'interest_rate',
        'duration',
        'total_payable',
        'outstanding_balance',
        'status',
        'type',
        'forced_by',
        'notes',
    ];

    protected $casts = [
        'amount'              => 'decimal:2',
        'interest_rate'       => 'decimal:2',
        'total_payable'       => 'decimal:2',
        'outstanding_balance' => 'decimal:2',
    ];

    /* ── Relationships ────────────────── */

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    public function forcedByUser()
    {
        return $this->belongsTo(User::class, 'forced_by');
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function approvals()
    {
        return $this->hasMany(LoanApproval::class);
    }

    public function pairings()
    {
        return $this->hasMany(LoanPairing::class);
    }

    public function repayments()
    {
        return $this->hasMany(Repayment::class);
    }

    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /* ── Scopes ────────────────────────── */

    public function scopeVoluntary($query)
    {
        return $query->where('type', 'voluntary');
    }

    public function scopeForced($query)
    {
        return $query->where('type', 'forced');
    }

    /* ── Helpers ────────────────────────── */

    public function isForced(): bool
    {
        return $this->type === 'forced';
    }
}
