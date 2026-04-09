<?php

namespace App\Models\Subscription;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class SubscriptionPayment extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'subscription_payments';

    protected $fillable = [
        'subscription_id', 'paid_by', 'amount', 'reference',
        'proof_file', 'status', 'admin_remarks',
        'reviewed_by', 'reviewed_at',
    ];

    protected $casts = [
        'amount'      => 'decimal:2',
        'reviewed_at' => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'paid_by');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
