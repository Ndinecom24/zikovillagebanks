<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A payment method (bank account or mobile money) belonging to a user.
 *
 * Types: 'bank', 'mobile_money'
 * Only one method per user should have is_primary = true.
 */
class UserPaymentMethod extends Model
{
    protected $table = 'user_payment_methods';

    protected $fillable = [
        'user_id',
        'type',
        'label',
        // Bank
        'bank_name',
        'account_name',
        'account_number',
        'branch_name',
        'swift_code',
        // Mobile Money
        'provider',
        'mobile_number',
        'registered_name',
        // Common
        'is_primary',
        'currency',
        'status',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /* ── Relationships ── */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* ── Scopes ── */

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeBank($query)
    {
        return $query->where('type', 'bank');
    }

    public function scopeMobileMoney($query)
    {
        return $query->where('type', 'mobile_money');
    }

    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /* ── Helpers ── */

    /**
     * Get a display-friendly summary of this method.
     */
    public function getSummaryAttribute(): string
    {
        if ($this->type === 'bank') {
            $masked = $this->account_number
                ? '****' . substr($this->account_number, -4)
                : '';
            return trim(($this->bank_name ?? '') . ' ' . $masked);
        }

        return trim(($this->provider ?? '') . ' ' . ($this->mobile_number ?? ''));
    }

    /**
     * Get an icon class for this payment type.
     */
    public function getIconAttribute(): string
    {
        return $this->type === 'bank' ? 'fas fa-university' : 'fas fa-mobile-alt';
    }
}
