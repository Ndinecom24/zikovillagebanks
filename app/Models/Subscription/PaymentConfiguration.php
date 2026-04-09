<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class PaymentConfiguration extends Model
{
    protected $table = 'payment_configurations';

    protected $fillable = [
        'method_name',
        'provider',
        'account_name',
        'account_number',
        'branch',
        'instructions',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /* ── Scopes ─────────────────────── */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('method_name');
    }

    /* ── Helpers ─────────────────────── */

    public function displayLabel(): string
    {
        $label = $this->method_name;
        if ($this->provider) {
            $label .= ' (' . $this->provider . ')';
        }
        return $label;
    }
}
