<?php

namespace App\Services;

use App\Models\Subscription\License;
use App\Models\Subscription\Subscription;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankMember;

class LicenseEnforcement
{
    protected ?int $bankId;
    protected ?VillageBank $bank;

    public function __construct(?int $villageBankId = null)
    {
        $this->bankId = $villageBankId ?? (int) session('current_village_bank_id');
        $this->bank   = null;
    }

    /**
     * Static factory for convenience.
     */
    public static function forBank(?int $bankId = null): self
    {
        return new static($bankId);
    }

    /* ──────────────────────────────────────────────
     *  License status helpers
     * ────────────────────────────────────────────── */

    /**
     * Whether the bank has a valid, non-expired license.
     */
    public function hasValidLicense(): bool
    {
        return License::where('village_bank_id', $this->bankId)
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->exists();
    }

    /**
     * Get the active subscription (with plan eager-loaded).
     */
    public function activeSubscription(): ?Subscription
    {
        return Subscription::with('plan')
            ->where('village_bank_id', $this->bankId)
            ->where('status', 'active')
            ->latest()
            ->first();
    }

    /**
     * Get the plan limits as an array.
     */
    public function planLimits(): array
    {
        $sub = $this->activeSubscription();

        if (! $sub || ! $sub->plan) {
            return [
                'max_members' => null,
                'max_circles' => null,
                'plan_name'   => 'No Plan',
                'features'    => [],
            ];
        }

        return [
            'max_members' => $sub->plan->max_members,
            'max_circles' => $sub->plan->max_circles,
            'plan_name'   => $sub->plan->name,
            'features'    => $sub->plan->features ?? [],
        ];
    }

    /* ──────────────────────────────────────────────
     *  Current usage counts
     * ────────────────────────────────────────────── */

    public function currentMemberCount(): int
    {
        return VillageBankMember::where('village_bank_id', $this->bankId)->count();
    }

    public function currentCircleCount(): int
    {
        return Circle::where('village_bank_id', $this->bankId)->count();
    }

    /* ──────────────────────────────────────────────
     *  Limit checks  (null limit = unlimited)
     * ────────────────────────────────────────────── */

    /**
     * Can we add more members?
     *
     * @param int $additional Number of new members to add (default 1)
     * @return array{allowed: bool, current: int, max: int|null, remaining: int|null, message: string}
     */
    public function canAddMembers(int $additional = 1): array
    {
        $limits  = $this->planLimits();
        $max     = $limits['max_members'];
        $current = $this->currentMemberCount();

        // null = unlimited
        if ($max === null) {
            return [
                'allowed'   => true,
                'current'   => $current,
                'max'       => null,
                'remaining' => null,
                'message'   => 'Unlimited members allowed.',
            ];
        }

        $remaining = $max - $current;
        $allowed   = $remaining >= $additional;

        return [
            'allowed'   => $allowed,
            'current'   => $current,
            'max'       => $max,
            'remaining' => max(0, $remaining),
            'message'   => $allowed
                ? "You can add {$remaining} more member(s). ({$current}/{$max})"
                : "Member limit reached. Your {$limits['plan_name']} plan allows {$max} members and you currently have {$current}. Please upgrade your subscription.",
        ];
    }

    /**
     * Can we create more circles?
     *
     * @param int $additional Number of new circles to add (default 1)
     * @return array{allowed: bool, current: int, max: int|null, remaining: int|null, message: string}
     */
    public function canAddCircles(int $additional = 1): array
    {
        $limits  = $this->planLimits();
        $max     = $limits['max_circles'];
        $current = $this->currentCircleCount();

        if ($max === null) {
            return [
                'allowed'   => true,
                'current'   => $current,
                'max'       => null,
                'remaining' => null,
                'message'   => 'Unlimited circles allowed.',
            ];
        }

        $remaining = $max - $current;
        $allowed   = $remaining >= $additional;

        return [
            'allowed'   => $allowed,
            'current'   => $current,
            'max'       => $max,
            'remaining' => max(0, $remaining),
            'message'   => $allowed
                ? "You can create {$remaining} more circle(s). ({$current}/{$max})"
                : "Circle limit reached. Your {$limits['plan_name']} plan allows {$max} circles and you currently have {$current}. Please upgrade your subscription.",
        ];
    }

    /**
     * Quick boolean checks.
     */
    public function membersAllowed(int $additional = 1): bool
    {
        return $this->canAddMembers($additional)['allowed'];
    }

    public function circlesAllowed(int $additional = 1): bool
    {
        return $this->canAddCircles($additional)['allowed'];
    }

    /**
     * Get a comprehensive usage summary for dashboards / UI.
     */
    public function usageSummary(): array
    {
        $limits  = $this->planLimits();
        $members = $this->canAddMembers();
        $circles = $this->canAddCircles();

        return [
            'plan_name'       => $limits['plan_name'],
            'has_license'     => $this->hasValidLicense(),
            'members'         => $members,
            'circles'         => $circles,
            'features'        => $limits['features'],
        ];
    }
}
