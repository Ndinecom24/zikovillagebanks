<?php

namespace App\Traits;

use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Month;
use Illuminate\Support\Facades\Auth;

/**
 * Provides village-bank scoping to Livewire components.
 *
 * Primary scoping source: session('current_village_bank_id')
 * set by the VillageBankSelector component.
 *
 * Super-admins with no bank selected see all data.
 * Regular users are always scoped to their selected bank.
 */
trait HasVillageBankScope
{
    /** Override in component to use per-component filter instead of session */
    public $villageBankId = '';

    /* ── Lifecycle hooks ──────────────────── */

    public function mountHasVillageBankScope()
    {
        // Auto-load from session if not already set
        if (empty($this->villageBankId)) {
            $this->villageBankId = session('current_village_bank_id', '');
        }
    }

    public function updatingVillageBankId()
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }
    }

    /* ── Computed: available village banks ── */

    public function getVillageBanksProperty()
    {
        $user = Auth::user();

        if ($user && $user->user_role_id == 1) {
            // Super-admin sees all active banks
            return VillageBank::where('status', 'active')
                ->orderBy('name')
                ->get(['id', 'name', 'code']);
        }

        // Regular user sees only their banks
        if ($user) {
            return $user->villageBanks()
                ->where('status', 'active')
                ->orderBy('name')
                ->get(['village_banks.id', 'village_banks.name', 'village_banks.code']);
        }

        return collect();
    }

    /* ── Resolve the active bank ID ────────── */

    /**
     * Returns the effective village bank ID for scoping queries.
     * Priority: component property → session → null (no filter).
     */
    protected function activeBankId()
    {
        if (!empty($this->villageBankId)) {
            return $this->villageBankId;
        }

        return session('current_village_bank_id');
    }

    /* ── Scope helpers ────────────────────── */

    /**
     * Return a Circle query builder scoped to the active village bank.
     */
    protected function scopedCircleQuery()
    {
        $query = Circle::query();
        $bankId = $this->activeBankId();

        if (!empty($bankId)) {
            $query->where('village_bank_id', $bankId);
        }

        return $query;
    }

    /**
     * Get circle IDs scoped to the active village bank.
     */
    protected function scopedCircleIds()
    {
        return $this->scopedCircleQuery()->pluck('id');
    }

    /**
     * Get month IDs scoped to the active village bank (through circles).
     */
    protected function scopedMonthIds()
    {
        $circleIds = $this->scopedCircleIds();
        return Month::whereIn('circle_id', $circleIds)->pluck('id');
    }

    /**
     * Apply bank scoping to any query that has a village_bank_id column.
     */
    protected function scopeByBank($query, $column = 'village_bank_id')
    {
        $bankId = $this->activeBankId();

        if (!empty($bankId)) {
            $query->where($column, $bankId);
        }

        return $query;
    }
}
