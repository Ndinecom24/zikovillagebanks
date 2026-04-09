<?php

namespace App\Services;

use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\InsuranceContribution;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankConfiguration;

class LoanEligibilityService
{
    /**
     * Calculate the maximum amount a borrower can request.
     *
     * Rules:
     * 1) Max = multiplier × (total shares + insurance the borrower has contributed in this circle so far)
     * 2) The requested amount cannot exceed the available pool for the given month.
     * 3) If the bank disallows multiple active loans, zero if borrower already has one.
     * 4) Optional hard min/max from config.
     *
     * @return array{
     *     max_borrowable: float,
     *     total_member_savings: float,
     *     multiplier: int,
     *     savings_limit: float,
     *     available_funds: float,
     *     has_active_loan: bool,
     *     errors: string[]
     * }
     */
    public static function calculate(int $borrowerId, int $monthId): array
    {
        $month  = Month::with('circle.villageBank.configuration')->findOrFail($monthId);
        $circle = $month->circle;
        $bank   = $circle->villageBank;

        $config = $bank?->configuration ?? VillageBankConfiguration::forBank($bank->id);

        $multiplier = $config->max_loan_multiplier;

        $errors = [];

        /* ── 0. Check month allows loan requests ──────────────── */
        if (!$month->allow_loan_requests) {
            $errors[] = 'Loan requests are not allowed in ' . ($month->label ?? 'Month ' . $month->month_number) . '.';
        }

        /* ── 1. Total member savings across ALL months in this circle ── */
        $circleMonthIds = Month::where('circle_id', $circle->id)->pluck('id');

        $totalShares    = ShareDeclaration::where('user_id', $borrowerId)
                            ->whereIn('month_id', $circleMonthIds)
                            ->sum('amount');

        $totalInsurance = InsuranceContribution::where('user_id', $borrowerId)
                            ->whereIn('month_id', $circleMonthIds)
                            ->sum('amount');

        $totalMemberSavings = (float) $totalShares + (float) $totalInsurance;
        $savingsLimit       = $totalMemberSavings * $multiplier;

        /* ── 2. Available funds for this month ─────────────────────── */
        $monthShares     = ShareDeclaration::where('month_id', $monthId)->sum('amount');
        $monthInsurance  = InsuranceContribution::where('month_id', $monthId)->sum('amount');

        // Repayments received during this month (across all loans in the circle)
        $circleLoanIds = Loan::whereIn('month_id', $circleMonthIds)->pluck('id');
        $monthRepayments = Repayment::whereIn('loan_id', $circleLoanIds)
                            ->whereMonth('created_at', $month->start_date->month)
                            ->whereYear('created_at', $month->start_date->year)
                            ->sum('amount_paid');

        $totalInflow = (float) $monthShares + (float) $monthInsurance + (float) $monthRepayments;

        // Subtract already-approved/active loans in this month
        $loansDisbursed = Loan::where('month_id', $monthId)
                            ->whereIn('status', ['approved', 'active'])
                            ->sum('amount');

        $availableFunds = max(0, $totalInflow - (float) $loansDisbursed);

        /* ── 3. Check for existing active loans ─────────────────────── */
        $hasActiveLoan = Loan::where('borrower_id', $borrowerId)
                            ->whereIn('month_id', $circleMonthIds)
                            ->whereIn('status', ['pending', 'approved', 'active'])
                            ->exists();

        if ($hasActiveLoan && !$config->allow_multiple_active_loans) {
            $errors[] = 'Member already has an active/pending loan in this circle.';
        }

        if ($totalMemberSavings <= 0) {
            $errors[] = 'Member has no savings (shares + insurance) in this circle yet.';
        }

        /* ── 4. Determine max borrowable ────────────────────────────── */
        $maxBorrowable = min($savingsLimit, $availableFunds);

        // Apply hard caps from config
        if ($config->min_loan_amount && $maxBorrowable < (float) $config->min_loan_amount) {
            $errors[] = 'Eligible amount (K' . number_format($maxBorrowable, 2) . ') is below minimum loan amount (K' . number_format($config->min_loan_amount, 2) . ').';
        }
        if ($config->max_loan_amount) {
            $maxBorrowable = min($maxBorrowable, (float) $config->max_loan_amount);
        }

        // Cannot be negative
        $maxBorrowable = max(0, $maxBorrowable);

        // If there are blocking errors, set to zero
        if (!empty($errors)) {
            $maxBorrowable = 0;
        }

        return [
            'max_borrowable'       => round($maxBorrowable, 2),
            'total_member_savings' => round($totalMemberSavings, 2),
            'multiplier'           => $multiplier,
            'savings_limit'        => round($savingsLimit, 2),
            'available_funds'      => round($availableFunds, 2),
            'month_inflow'         => round($totalInflow, 2),
            'month_loans_out'      => round((float) $loansDisbursed, 2),
            'has_active_loan'      => $hasActiveLoan,
            'errors'               => $errors,
        ];
    }
}
