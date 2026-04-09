<?php

namespace App\Models\Subscription;

use App\Models\User;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class BankApplication extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'bank_applications';

    protected $fillable = [
        'bank_name', 'bank_code', 'bank_description', 'bank_address',
        'bank_phone', 'bank_email',
        'contact_name', 'contact_email', 'contact_phone', 'contact_staff_no',
        'subscription_plan_id', 'proof_file', 'payment_reference',
        'status', 'admin_remarks', 'reviewed_by', 'reviewed_at',
        'village_bank_id',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }
}
