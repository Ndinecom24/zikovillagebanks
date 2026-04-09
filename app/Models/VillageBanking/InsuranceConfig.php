<?php

namespace App\Models\VillageBanking;

use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceConfig extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'circle';

    protected $table = 'insurance_configs';

    protected $fillable = [
        'circle_id',
        'type',
        'value',
    ];

    protected $casts = [
        'value' => 'decimal:2',
    ];

    /* ── Relationships ────────────────── */

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }
}
