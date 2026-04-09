<?php

namespace App\Traits;

use App\Scopes\VillageBankScope;

/**
 * Add this trait to any VillageBanking model that needs automatic
 * data-segregation based on the authenticated user's village banks.
 *
 * Set the scoping tier via class properties:
 *
 *   public string $villageBankScopeTier = 'direct';   // has village_bank_id
 *   public string $villageBankScopeTier = 'circle';   // has circle_id
 *   public string $villageBankScopeTier = 'month';    // has month_id
 *   public string $villageBankScopeTier = 'loan';     // has loan_id
 *
 * Optionally override the FK column name:
 *   public string $villageBankScopeColumn = 'custom_column';
 *
 * Super-admins and console contexts bypass the scope automatically.
 */
trait ScopedToVillageBank
{
    public static function bootScopedToVillageBank(): void
    {
        static::addGlobalScope(new VillageBankScope());
    }

    /**
     * Query without the village-bank scope (e.g. for admin panels).
     */
    public static function withoutBankScope()
    {
        return static::withoutGlobalScope(VillageBankScope::class);
    }
}
