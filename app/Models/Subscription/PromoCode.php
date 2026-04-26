<?php

namespace App\Models\Subscription;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'description', 'type', 'value',
        'min_plan_price', 'max_uses', 'times_used',
        'max_uses_per_bank', 'plan_id',
        'starts_at', 'expires_at', 'is_active',
    ];

    protected $casts = [
        'value'          => 'decimal:2',
        'min_plan_price' => 'decimal:2',
        'is_active'      => 'boolean',
        'starts_at'      => 'datetime',
        'expires_at'     => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'plan_id');
    }

    public function usages()
    {
        return $this->hasMany(PromoCodeUsage::class);
    }

    /* ── Scopes ───────────────────────── */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /* ── Validation / eligibility ─────── */

    /**
     * Check if the promo code is currently valid (ignoring per-bank limits).
     */
    public function isValid(): bool
    {
        if (! $this->is_active) {
            return false;
        }

        $now = Carbon::now();

        if ($this->starts_at && $now->lt($this->starts_at)) {
            return false;
        }

        if ($this->expires_at && $now->gt($this->expires_at)) {
            return false;
        }

        if ($this->max_uses !== null && $this->times_used >= $this->max_uses) {
            return false;
        }

        return true;
    }

    /**
     * Validate promo code for a specific plan + village bank.
     *
     * Returns ['valid' => bool, 'error' => string|null, 'discount' => float]
     */
    public function validateFor(SubscriptionPlan $plan, int $villageBankId): array
    {
        if (! $this->isValid()) {
            return ['valid' => false, 'error' => 'This promo code is no longer valid.', 'discount' => 0];
        }

        // Restricted to a specific plan?
        if ($this->plan_id && $this->plan_id !== $plan->id) {
            return ['valid' => false, 'error' => 'This code is not valid for the selected plan.', 'discount' => 0];
        }

        // Minimum price check
        if ((float) $plan->price < (float) $this->min_plan_price) {
            return [
                'valid' => false,
                'error' => 'Plan must cost at least K' . number_format($this->min_plan_price, 2) . ' to use this code.',
                'discount' => 0,
            ];
        }

        // Per-bank usage limit
        $bankUsages = $this->usages()->where('village_bank_id', $villageBankId)->count();
        if ($bankUsages >= $this->max_uses_per_bank) {
            return ['valid' => false, 'error' => 'This code has already been used for your village bank.', 'discount' => 0];
        }

        // Calculate discount
        $discount = $this->calculateDiscount($plan);

        return ['valid' => true, 'error' => null, 'discount' => $discount];
    }

    /**
     * Calculate the discount amount for a plan.
     */
    public function calculateDiscount(SubscriptionPlan $plan): float
    {
        // Apply plan-level discount first to get effective price
        $basePrice = $plan->effectivePrice();

        if ($this->type === 'percentage') {
            return round($basePrice * ($this->value / 100), 2);
        }

        return min((float) $this->value, $basePrice);
    }

    /**
     * Record that this code was used.
     */
    public function recordUsage(int $villageBankId, ?int $subscriptionId, float $discountApplied): void
    {
        $this->usages()->create([
            'village_bank_id'  => $villageBankId,
            'subscription_id'  => $subscriptionId,
            'discount_applied' => $discountApplied,
        ]);

        $this->increment('times_used');
    }

    /* ── Display helpers ──────────────── */

    public function discountLabel(): string
    {
        if ($this->type === 'percentage') {
            return (int) $this->value . '% off';
        }

        return 'K' . number_format($this->value, 0) . ' off';
    }

    public function timeRemaining(): ?string
    {
        if (! $this->expires_at) {
            return 'No expiry';
        }

        if (Carbon::now()->gt($this->expires_at)) {
            return 'Expired';
        }

        $diff = Carbon::now()->diff($this->expires_at);

        if ($diff->days > 0) {
            return $diff->days . 'd left';
        }

        return $diff->h . 'h ' . $diff->i . 'm left';
    }
}
