<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'direct';

    protected $table = 'village_bank_join_requests';

    protected $fillable = [
        'user_id',
        'village_bank_id',
        'status',
        'guarantor_username',
        'guarantor_id',
        'message',
        'admin_remarks',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }

    public function guarantor()
    {
        return $this->belongsTo(User::class, 'guarantor_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /* ── Scopes ────────────────────────── */

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /* ── Helpers ────────────────────────── */

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Resolve guarantor_username to a User record.
     */
    public function resolveGuarantor(): ?User
    {
        if ($this->guarantor_id) {
            return $this->guarantor;
        }

        if (!empty($this->guarantor_username)) {
            return User::where('username', $this->guarantor_username)->first();
        }

        return null;
    }
}
