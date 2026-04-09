<?php

namespace App\Models\VillageBanking;

use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'circle';

    protected $table = 'months';

    protected $fillable = [
        'circle_id',
        'month_number',
        'label',
        'start_date',
        'end_date',
        'status',
        'allow_share_declarations',
        'allow_insurance_declarations',
        'allow_loan_requests',
        'allow_loan_repayments',
        'is_shareout_month',
    ];

    protected $casts = [
        'start_date'                   => 'date',
        'end_date'                     => 'date',
        'allow_share_declarations'     => 'boolean',
        'allow_insurance_declarations' => 'boolean',
        'allow_loan_requests'          => 'boolean',
        'allow_loan_repayments'        => 'boolean',
        'is_shareout_month'            => 'boolean',
    ];

    /* ── Relationships ────────────────── */

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function phases()
    {
        return $this->hasMany(Phase::class);
    }

    public function shareDeclarations()
    {
        return $this->hasMany(ShareDeclaration::class);
    }

    public function insuranceContributions()
    {
        return $this->hasMany(InsuranceContribution::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
