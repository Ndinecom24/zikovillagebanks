<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;
use Carbon\Carbon;

class SubscriptionPlan extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'subscription_plans';

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'billing_cycle',
        'duration_days', 'max_circles', 'max_members', 'features',
        'is_active', 'sort_order', 'is_featured',
        'discount_type', 'discount_value', 'discount_starts_at',
        'discount_ends_at', 'discount_label',
    ];

    protected $casts = [
        'price'              => 'decimal:2',
        'discount_value'     => 'decimal:2',
        'is_active'          => 'boolean',
        'is_featured'        => 'boolean',
        'features'           => 'array',
        'discount_starts_at' => 'datetime',
        'discount_ends_at'   => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function bankApplications()
    {
        return $this->hasMany(BankApplication::class);
    }

    public function promoCodes()
    {
        return $this->hasMany(PromoCode::class, 'plan_id');
    }

    /* ── Discount logic ───────────────── */

    /**
     * Is a plan-level discount currently running?
     */
    public function hasActiveDiscount(): bool
    {
        if ($this->discount_type === 'none' || $this->discount_value <= 0) {
            return false;
        }

        $now = Carbon::now();

        if ($this->discount_starts_at && $now->lt($this->discount_starts_at)) {
            return false;
        }

        if ($this->discount_ends_at && $now->gt($this->discount_ends_at)) {
            return false;
        }

        return true;
    }

    /**
     * Calculate the discount amount in Kwacha for the plan-level promotion.
     */
    public function discountAmount(): float
    {
        if (! $this->hasActiveDiscount()) {
            return 0;
        }

        if ($this->discount_type === 'percentage') {
            return round($this->price * ($this->discount_value / 100), 2);
        }

        // Fixed amount — capped to the plan price
        return min((float) $this->discount_value, (float) $this->price);
    }

    /**
     * The effective price after applying the plan-level discount.
     */
    public function effectivePrice(): float
    {
        return max(0, round((float) $this->price - $this->discountAmount(), 2));
    }

    /**
     * Returns how many days/hours remain on the current promotion.
     */
    public function discountTimeRemaining(): ?string
    {
        if (! $this->hasActiveDiscount() || ! $this->discount_ends_at) {
            return null;
        }

        $diff = Carbon::now()->diff($this->discount_ends_at);

        if ($diff->days > 0) {
            return $diff->days . ' day' . ($diff->days > 1 ? 's' : '') . ' left';
        }

        return $diff->h . 'h ' . $diff->i . 'm left';
    }

    /**
     * Granular countdown array for visual countdown display.
     */
    public function discountCountdown(): ?array
    {
        if (! $this->hasActiveDiscount() || ! $this->discount_ends_at) {
            return null;
        }

        $now  = Carbon::now();
        $end  = $this->discount_ends_at;

        return [
            'days'    => $now->diffInDays($end),
            'hours'   => $now->copy()->addDays($now->diffInDays($end))->diffInHours($end) % 24,
            'minutes' => $now->copy()->addDays($now->diffInDays($end))
                              ->addHours($now->copy()->addDays($now->diffInDays($end))->diffInHours($end) % 24)
                              ->diffInMinutes($end) % 60,
            'total_days' => $now->diffInDays($end),
            'end_date'   => $end->format('d M Y'),
            'urgent'     => $now->diffInDays($end) <= 3,
        ];
    }

    /**
     * Formatted discount end date for display.
     */
    public function discountEndsFormatted(): ?string
    {
        if (! $this->hasActiveDiscount() || ! $this->discount_ends_at) {
            return null;
        }

        return $this->discount_ends_at->format('d M Y');
    }

    /**
     * Whether the deal is ending soon (≤ 3 days).
     */
    public function isDiscountUrgent(): bool
    {
        if (! $this->hasActiveDiscount() || ! $this->discount_ends_at) {
            return false;
        }

        return Carbon::now()->diffInDays($this->discount_ends_at) <= 3;
    }

    /**
     * Human-readable discount badge text.
     */
    public function discountBadge(): string
    {
        if (! $this->hasActiveDiscount()) {
            return '';
        }

        if ($this->discount_type === 'percentage') {
            return (int) $this->discount_value . '% OFF';
        }

        return 'K' . number_format($this->discount_value, 0) . ' OFF';
    }

    /**
     * Percentage saved (for display in savings badges).
     */
    public function savingsPercentage(): int
    {
        if ((float) $this->price <= 0 || ! $this->hasActiveDiscount()) {
            return 0;
        }

        return (int) round(($this->discountAmount() / (float) $this->price) * 100);
    }

    /* ── Price helpers ────────────────── */

    public function formattedPrice(): string
    {
        return 'K' . number_format($this->price, 2);
    }

    public function formattedEffectivePrice(): string
    {
        return 'K' . number_format($this->effectivePrice(), 2);
    }

    public function cycleName(): string
    {
        return match ($this->billing_cycle) {
            'monthly'   => '/month',
            'quarterly' => '/quarter',
            'yearly'    => '/year',
            default     => '',
        };
    }
}
