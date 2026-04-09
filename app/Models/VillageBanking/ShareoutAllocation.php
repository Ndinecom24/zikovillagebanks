<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareoutAllocation extends Model
{
    use HasFactory;

    protected $table = 'shareout_allocations';

    public $timestamps = false;

    protected $fillable = [
        'shareout_id',
        'user_id',
        'contribution_total',
        'profit_share',
        'payout_amount',
    ];

    protected $casts = [
        'contribution_total' => 'decimal:2',
        'profit_share'       => 'decimal:2',
        'payout_amount'      => 'decimal:2',
    ];

    /* ── Relationships ────────────────── */

    public function shareout()
    {
        return $this->belongsTo(Shareout::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
