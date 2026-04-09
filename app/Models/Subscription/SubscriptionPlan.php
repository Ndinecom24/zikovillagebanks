<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;

class SubscriptionPlan extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'subscription_plans';

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'billing_cycle',
        'duration_days', 'max_circles', 'max_members', 'features',
        'is_active', 'sort_order', 'is_featured',
    ];

    protected $casts = [
        'price'       => 'decimal:2',
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'features'    => 'array',
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

    /* ── Helpers ──────────────────────── */

    public function formattedPrice(): string
    {
        return 'K' . number_format($this->price, 2);
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
