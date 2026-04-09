<?php

namespace App\Services;

use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\InsuranceContribution;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\LoanApproval;
use App\Models\VillageBanking\LoanPairing;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\VillageBankConfiguration;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ForcedLoanService
{
    /**
     * Analyse a month and compute forced-loan allocations.
     *
     * Returns:
     *  - pool_summary  (total_inflow, total_borrowed, unborrowed)
     *  - allocations[]  per eligible member with computed amounts
     *  - eligible_count, ineligible (members with existing loans)
     *
     * @return array
     */
    public static function simulate(int $monthId): array
    {
        $month  = Month::with('circle.villageBank.configuration')->findOrFail($monthId);
        $circle = $month->circle;
        $config = $circle->villageBank?->configuration
                  ?? VillageBankConfiguration::forBank($circle->village_bank_id);

        $circleMonthIds = Month::where('circle_id', $circle->id)->pluck('id');

        /* ── 1. Compute month pool ─────────────────────────── */
        $monthShares    = (float) ShareDeclaration::where('month_id', $monthId)->sum('amount');
        $monthInsurance = (float) InsuranceContribution::where('month_id', $monthId)->sum('amount');

        $circleLoanIds  = Loan::whereIn('month_id', $circleMonthIds)->pluck('id');
        $monthRepay     = (float) Repayment::whereIn('loan_id', $circleLoanIds)
                            ->whereMonth('created_at', $month->start_date->month)
                            ->whereYear('created_at', $month->start_date->year)
                            ->sum('amount_paid');

        $totalInflow = $monthShares + $monthInsurance + $monthRepay;

        $totalBorrowed = (float) Loan::where('month_id', $monthId)
                            ->whereIn('status', ['pending', 'approved', 'active'])
                            ->sum('amount');

        $unborrowed = max(0, $totalInflow - $totalBorrowed);

        /* ── 2. Get circle members & their savings ─────────── */
        $circleMembers = $circle->members()
            ->where('status', 'active')
            ->get();

        $interestRate = (float) $config->default_interest_rate;
        $duration     = (int) $config->default_loan_duration;
        $multiplier   = (int) $config->max_loan_multiplier;

        $allocations  = [];
        $ineligible   = [];

        foreach ($circleMembers as $member) {
            $memberId = $member->id;

            // Member's total shares across all months in this circle
            $memberShares = (float) ShareDeclaration::where('user_id', $memberId)
                ->whereIn('month_id', $circleMonthIds)
                ->sum('amount');

            $memberInsurance = (float) InsuranceContribution::where('user_id', $memberId)
                ->whereIn('month_id', $circleMonthIds)
                ->sum('amount');

            $memberSavings = $memberShares + $memberInsurance;

            // Member's share declared THIS month (used for proportional split)
            $memberMonthShare = (float) ShareDeclaration::where('user_id', $memberId)
                ->where('month_id', $monthId)
                ->sum('amount');

            // Check if member already has an active/pending/approved loan
            $hasLoan = Loan::where('borrower_id', $memberId)
                ->whereIn('month_id', $circleMonthIds)
                ->whereIn('status', ['pending', 'approved', 'active'])
                ->exists();

            // Savings-based max
            $savingsLimit = $memberSavings * $multiplier;
            if ($config->max_loan_amount) {
                $savingsLimit = min($savingsLimit, (float) $config->max_loan_amount);
            }

            if ($hasLoan && !$config->allow_multiple_active_loans) {
                $ineligible[] = [
                    'member_id'      => $member->id,
                    'member_name'    => $member->name,
                    'member_email'   => $member->email,
                    'reason'         => 'Already has an active/pending loan',
                    'month_share'    => $memberMonthShare,
                    'total_savings'  => $memberSavings,
                ];
                continue;
            }

            if ($memberSavings <= 0) {
                $ineligible[] = [
                    'member_id'     => $member->id,
                    'member_name'   => $member->name,
                    'member_email'  => $member->email,
                    'reason'        => 'No savings in this circle',
                    'month_share'   => 0,
                    'total_savings' => 0,
                ];
                continue;
            }

            $allocations[] = [
                'member_id'       => $member->id,
                'member_name'     => $member->name,
                'member_email'    => $member->email,
                'month_share'     => $memberMonthShare,
                'total_savings'   => $memberSavings,
                'savings_limit'   => $savingsLimit,
                'computed_amount' => 0, // will be filled after proportional calc
            ];
        }

        /* ── 3. Proportional distribution ──────────────────── */
        $totalEligibleShares = array_sum(array_column($allocations, 'month_share'));

        if ($unborrowed > 0 && $totalEligibleShares > 0) {
            foreach ($allocations as &$alloc) {
                $proportion = $alloc['month_share'] / $totalEligibleShares;
                $rawAmount  = $unborrowed * $proportion;

                // Cap at savings limit
                $alloc['computed_amount'] = round(min($rawAmount, $alloc['savings_limit']), 2);
            }
            unset($alloc);

            // Second pass: if any member was capped, redistribute the leftover
            $totalAllocated = array_sum(array_column($allocations, 'computed_amount'));
            $leftover = $unborrowed - $totalAllocated;

            if ($leftover > 0.01) {
                // Find uncapped members
                $uncapped = array_filter($allocations, fn($a) =>
                    $a['computed_amount'] < $a['savings_limit']
                );

                $uncappedShares = array_sum(array_column($uncapped, 'month_share'));
                if ($uncappedShares > 0) {
                    foreach ($allocations as &$alloc) {
                        if ($alloc['computed_amount'] < $alloc['savings_limit']) {
                            $extra = $leftover * ($alloc['month_share'] / $uncappedShares);
                            $alloc['computed_amount'] = round(
                                min($alloc['computed_amount'] + $extra, $alloc['savings_limit']),
                                2
                            );
                        }
                    }
                    unset($alloc);
                }
            }
        }

        return [
            'month'        => $month,
            'circle'       => $circle,
            'config'       => $config,
            'pool_summary' => [
                'month_shares'    => $monthShares,
                'month_insurance' => $monthInsurance,
                'month_repay'     => $monthRepay,
                'total_inflow'    => $totalInflow,
                'total_borrowed'  => $totalBorrowed,
                'unborrowed'      => $unborrowed,
            ],
            'interest_rate'    => $interestRate,
            'duration'         => $duration,
            'allocations'      => $allocations,
            'ineligible'       => $ineligible,
            'eligible_count'   => count($allocations),
            'ineligible_count' => count($ineligible),
        ];
    }

    /**
     * Execute the forced loan — create Loan + LoanApproval + LoanPairing records.
     *
     * @param  int    $monthId
     * @param  array  $amounts   [ user_id => amount, ... ]  (admin-finalised)
     * @param  int    $adminId   The admin performing the action
     * @return array  { created_count, total_amount, loans[] }
     */
    public static function execute(int $monthId, array $amounts, int $adminId): array
    {
        $month  = Month::with('circle.villageBank.configuration')->findOrFail($monthId);
        $circle = $month->circle;
        $config = $circle->villageBank?->configuration
                  ?? VillageBankConfiguration::forBank($circle->village_bank_id);

        $interestRate = (float) $config->default_interest_rate;
        $duration     = (int) $config->default_loan_duration;

        $circleMonthIds = Month::where('circle_id', $circle->id)->pluck('id');

        $createdLoans = [];
        $totalAmount  = 0;

        DB::transaction(function () use (
            $amounts, $monthId, $adminId, $interestRate, $duration,
            $circleMonthIds, $circle, $config,
            &$createdLoans, &$totalAmount
        ) {
            foreach ($amounts as $borrowerId => $amount) {
                $amount = (float) $amount;
                if ($amount <= 0) continue;

                // Skip if member already has active loan (safety check)
                if (!$config->allow_multiple_active_loans) {
                    $hasLoan = Loan::where('borrower_id', $borrowerId)
                        ->whereIn('month_id', $circleMonthIds)
                        ->whereIn('status', ['pending', 'approved', 'active'])
                        ->exists();
                    if ($hasLoan) continue;
                }

                $totalPayable = round($amount * (1 + $interestRate / 100), 2);

                // Create loan with status = approved, type = forced
                $loan = Loan::create([
                    'borrower_id'         => $borrowerId,
                    'month_id'            => $monthId,
                    'amount'              => $amount,
                    'interest_rate'       => $interestRate,
                    'duration'            => $duration,
                    'total_payable'       => $totalPayable,
                    'outstanding_balance' => $totalPayable,
                    'status'              => 'approved',
                    'type'                => 'forced',
                    'forced_by'           => $adminId,
                    'notes'               => 'Auto-generated forced loan to distribute unborrowed funds.',
                ]);

                // Create approval record
                LoanApproval::create([
                    'loan_id'     => $loan->id,
                    'approved_by' => $adminId,
                    'status'      => 'approved',
                    'remarks'     => 'Forced loan — auto-approved.',
                ]);

                // Auto-pair: distribute lending proportionally among other members
                self::autoPair($loan, $circle, $circleMonthIds, $monthId);

                $createdLoans[] = $loan;
                $totalAmount += $amount;
            }
        });

        return [
            'created_count' => count($createdLoans),
            'total_amount'  => round($totalAmount, 2),
            'loans'         => $createdLoans,
        ];
    }

    /**
     * Auto-pair a forced loan — distributes lending proportionally
     * based on each lender's share declarations for the month.
     */
    protected static function autoPair(Loan $loan, Circle $circle, $circleMonthIds, int $monthId): void
    {
        // Get all members except the borrower
        $lenders = $circle->members()
            ->where('users.id', '!=', $loan->borrower_id)
            ->where('status', 'active')
            ->get();

        if ($lenders->isEmpty()) return;

        // Each lender's share in this month
        $lenderShares = [];
        foreach ($lenders as $lender) {
            $share = (float) ShareDeclaration::where('user_id', $lender->id)
                ->where('month_id', $monthId)
                ->sum('amount');
            if ($share > 0) {
                $lenderShares[$lender->id] = $share;
            }
        }

        $totalLenderShares = array_sum($lenderShares);
        if ($totalLenderShares <= 0) return;

        $remaining = (float) $loan->amount;

        foreach ($lenderShares as $lenderId => $share) {
            $proportion = $share / $totalLenderShares;
            $pairAmount = round($remaining * $proportion, 2);

            if ($pairAmount > 0) {
                LoanPairing::create([
                    'loan_id'   => $loan->id,
                    'lender_id' => $lenderId,
                    'amount'    => $pairAmount,
                ]);
            }
        }

        // If fully paired → active
        $totalPaired = LoanPairing::where('loan_id', $loan->id)->sum('amount');
        if ($totalPaired >= $loan->amount) {
            $loan->update(['status' => 'active']);
        }
    }
}
