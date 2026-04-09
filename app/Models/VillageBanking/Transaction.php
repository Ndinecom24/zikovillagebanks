<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'month';

    protected $table = 'transactions';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'loan_id',
        'month_id',
        'amount',
        'payment_method_id',
        'proof_file',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /* ── Relationships ────────────────── */

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
