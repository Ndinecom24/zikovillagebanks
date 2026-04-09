<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class Circle extends Model
{
    use HasFactory;
    use LogsActivity;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'direct';

    protected $table = 'circles';

    protected $fillable = [
        'name',
        'village_bank_id',
        'duration_months',
        'start_date',
        'end_date',
        'status',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    /* ── Relationships ────────────────── */

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'circle_members')
                    ->using(CircleMember::class)
                    ->withPivot('joined_at');
    }

    public function circleMemberships()
    {
        return $this->hasMany(CircleMember::class);
    }

    public function months()
    {
        return $this->hasMany(Month::class);
    }

    public function insuranceConfig()
    {
        return $this->hasOne(InsuranceConfig::class);
    }

    public function shareout()
    {
        return $this->hasOne(Shareout::class);
    }
}
