<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareDeclaration extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'month';

    protected $table = 'share_declarations';

    protected $fillable = [
        'user_id',
        'month_id',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /* ── Relationships ────────────────── */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }
}
