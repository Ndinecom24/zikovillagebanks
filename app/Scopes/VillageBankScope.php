<?php

namespace App\Scopes;

use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\VillageBankMember;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

/**
 * Global scope that restricts query results to the user's village banks.
 *
 * Scoping tiers (set via $model->villageBankScopeTier):
 *   'direct'  → model has village_bank_id column
 *   'circle'  → model has circle_id → circle belongs to VB
 *   'month'   → model has month_id  → month→circle→VB
 *   'loan'    → model has loan_id   → loan→month→circle→VB
 *
 * Super-admins (user_role_id = 1) bypass entirely.
 * Console/queue contexts (no auth user) bypass entirely.
 */
class VillageBankScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // Skip in console (artisan commands, queues, seeders)
        if (app()->runningInConsole() && !app()->runningUnitTests()) {
            return;
        }

        $user = Auth::user();

        // No authenticated user → skip (login page, public routes)
        if (!$user) {
            return;
        }

        // Super-admin bypasses all scoping
        if ($user->isSuperAdmin()) {
            return;
        }

        $bankIds = $user->villageBankIds();

        // If user belongs to zero banks, restrict to nothing
        if (empty($bankIds)) {
            $builder->whereRaw('0 = 1');
            return;
        }

        $tier = $model->villageBankScopeTier ?? 'direct';
        $fkColumn = $model->villageBankScopeColumn ?? null;

        switch ($tier) {
            case 'direct':
                $col = $fkColumn ?? 'village_bank_id';
                $builder->whereIn($model->getTable() . '.' . $col, $bankIds);
                break;

            case 'circle':
                $col = $fkColumn ?? 'circle_id';
                $circleIds = Circle::whereIn('village_bank_id', $bankIds)->pluck('id');
                $builder->whereIn($model->getTable() . '.' . $col, $circleIds);
                break;

            case 'month':
                $col = $fkColumn ?? 'month_id';
                $circleIds = Circle::whereIn('village_bank_id', $bankIds)->pluck('id');
                $monthIds = Month::whereIn('circle_id', $circleIds)->pluck('id');
                $builder->whereIn($model->getTable() . '.' . $col, $monthIds);
                break;

            case 'loan':
                $col = $fkColumn ?? 'loan_id';
                $circleIds = Circle::whereIn('village_bank_id', $bankIds)->pluck('id');
                $monthIds = Month::whereIn('circle_id', $circleIds)->pluck('id');
                $loanIds = Loan::withoutGlobalScope(self::class)
                    ->whereIn('month_id', $monthIds)
                    ->pluck('id');
                $builder->whereIn($model->getTable() . '.' . $col, $loanIds);
                break;
        }
    }
}
