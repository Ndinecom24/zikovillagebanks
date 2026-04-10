<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * Seeds Village Bank #1: "InfraCash 2025"
 *
 * Data sourced from: docs/sample-excels-vbank/InfraCash2025 Records - Share Out.xlsx
 *
 * Circle runs: November 2024 – October 2025 (12 months)
 * Share unit: K200
 * Insurance: K200/month (fixed)
 * Interest rate: 5% monthly compound (reducing balance)
 * Loan eligibility: 3× total invested
 * 25 members
 */
class InfraCashVillageBankSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // ──────────────────────────────────────────────────────
        // 1. CREATE ADMIN USER (creator of the bank)
        // ──────────────────────────────────────────────────────
        $adminId = DB::table('users')->insertGetId([
            'name'       => 'InfraCash Admin',
            'username'   => 'infracash_admin',
            'email'      => 'admin@infracash.test',
            'password'   => Hash::make('Password1!'),
            'status'     => 'active',
            'usertype'   => 1,
            'phone'      => '0971000000',
            'mobile_no'  => '0971000000',
            'total_login' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // ──────────────────────────────────────────────────────
        // 2. CREATE MEMBERS
        // ──────────────────────────────────────────────────────
        $memberNames = [
            'Abigail Mundia', 'Abel Kunda', 'Andrew Chola', 'Arthur Mbewe',
            'Evans Banda', 'Jesper Lungu', 'Joshua Tembo', 'Kampamba Mwale',
            'Karen Mwinga', 'Keji Phiri', 'Kombe Musonda', 'Khucwayo Mulenga',
            'Kwibisa Kalumba', 'Michael Zulu', 'Millie Bwalya', 'Mukuma Chilufya',
            'Mumba Kapasa', 'Mumbi Chanda', 'Mwenya Sakala', 'Nyanyiwe Tembo',
            'Pamela Mwansa', 'Schuller Katongo', 'Shubart Nyimbili', 'Solomon Banda',
            'Tumelo Ngosa',
        ];

        $userIds = [];
        foreach ($memberNames as $i => $name) {
            $slug = strtolower(str_replace(' ', '.', $name));
            $userIds[$name] = DB::table('users')->insertGetId([
                'name'       => $name,
                'username'   => $slug,
                'email'      => $slug . '@infracash.test',
                'password'   => Hash::make('Password1!'),
                'status'     => 'active',
                'usertype'   => 2,
                'phone'      => '097' . str_pad($i + 1, 7, '0', STR_PAD_LEFT),
                'mobile_no'  => '097' . str_pad($i + 1, 7, '0', STR_PAD_LEFT),
                'total_login' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // ──────────────────────────────────────────────────────
        // 3. CREATE VILLAGE BANK
        // ──────────────────────────────────────────────────────
        $bankId = DB::table('village_banks')->insertGetId([
            'name'        => 'InfraCash 2025',
            'code'        => 'INFRA2025',
            'description' => 'InfraCash Village Bank — November 2024 to October 2025 cycle. 25 members. Share unit K200, 5% monthly compound interest.',
            'status'      => 'active',
            'created_by'  => $adminId,
            'created_at'  => $now,
            'updated_at'  => $now,
        ]);

        // ──────────────────────────────────────────────────────
        // 4. VILLAGE BANK MEMBERS
        // ──────────────────────────────────────────────────────
        // Admin
        DB::table('village_bank_members')->insert([
            'village_bank_id' => $bankId,
            'user_id'         => $adminId,
            'role'            => 'admin',
            'joined_at'       => Carbon::parse('2024-10-15'),
            'created_at'      => $now,
            'updated_at'      => $now,
        ]);
        foreach ($userIds as $name => $uid) {
            DB::table('village_bank_members')->insert([
                'village_bank_id' => $bankId,
                'user_id'         => $uid,
                'role'            => 'member',
                'joined_at'       => Carbon::parse('2024-10-20'),
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);
        }

        // ──────────────────────────────────────────────────────
        // 5. VILLAGE BANK CONFIGURATION
        // ──────────────────────────────────────────────────────
        DB::table('village_bank_configurations')->insert([
            'village_bank_id'          => $bankId,
            'circle_duration_months'   => 12,
            'share_unit_amount'        => 200.00,
            'min_shares_per_month'     => 1,
            'max_shares_per_month'     => 100,
            'insurance_type'           => 'fixed',
            'insurance_value'          => 200.00,
            'max_loan_multiplier'      => 3,
            'default_interest_rate'    => 10.00,  // 10% service fee on new loans
            'interest_type'            => 'reducing_balance',
            'reducing_balance_rate'    => 5.00,   // 5% monthly compound
            'default_loan_duration'    => 1,
            'allow_multiple_active_loans' => false,
            'late_repayment_penalty_rate' => 5.00,
            'grace_period_days'        => 0,
            'created_at'               => $now,
            'updated_at'               => $now,
        ]);

        // ──────────────────────────────────────────────────────
        // 6. CIRCLE
        // ──────────────────────────────────────────────────────
        $circleId = DB::table('circles')->insertGetId([
            'village_bank_id' => $bankId,
            'name'            => 'InfraCash Cycle 2024/2025',
            'duration_months' => 12,
            'start_date'      => '2024-11-01',
            'end_date'        => '2025-10-31',
            'status'          => 'active',
            'created_by'      => $adminId,
            'created_at'      => $now,
            'updated_at'      => $now,
        ]);

        // ──────────────────────────────────────────────────────
        // 7. CIRCLE MEMBERS
        // ──────────────────────────────────────────────────────
        DB::table('circle_members')->insert([
            'circle_id' => $circleId,
            'user_id'   => $adminId,
            'joined_at' => Carbon::parse('2024-10-15'),
        ]);
        foreach ($userIds as $uid) {
            DB::table('circle_members')->insert([
                'circle_id' => $circleId,
                'user_id'   => $uid,
                'joined_at' => Carbon::parse('2024-10-20'),
            ]);
        }

        // ──────────────────────────────────────────────────────
        // 8. INSURANCE CONFIG
        // ──────────────────────────────────────────────────────
        DB::table('insurance_configs')->insert([
            'circle_id'  => $circleId,
            'type'       => 'fixed',
            'value'      => 200.00,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // ──────────────────────────────────────────────────────
        // 9. MONTHS (Nov 2024 – Oct 2025)
        // ──────────────────────────────────────────────────────
        $monthMap = []; // label => month_id
        $monthLabels = [
            1  => ['Nov', '2024-11-01', '2024-11-30'],
            2  => ['Dec', '2024-12-01', '2024-12-31'],
            3  => ['Jan', '2025-01-01', '2025-01-31'],
            4  => ['Feb', '2025-02-01', '2025-02-28'],
            5  => ['Mar', '2025-03-01', '2025-03-31'],
            6  => ['Apr', '2025-04-01', '2025-04-30'],
            7  => ['May', '2025-05-01', '2025-05-31'],
            8  => ['Jun', '2025-06-01', '2025-06-30'],
            9  => ['Jul', '2025-07-01', '2025-07-31'],
            10 => ['Aug', '2025-08-01', '2025-08-31'],
            11 => ['Sep', '2025-09-01', '2025-09-30'],
            12 => ['Oct', '2025-10-01', '2025-10-31'],
        ];

        foreach ($monthLabels as $num => [$label, $start, $end]) {
            $monthMap[$label] = DB::table('months')->insertGetId([
                'circle_id'    => $circleId,
                'month_number' => $num,
                'label'        => $label,
                'start_date'   => $start,
                'end_date'     => $end,
                'status'       => ($num <= 10) ? 'closed' : 'pending',
                'allow_share_declarations'     => true,
                'allow_insurance_declarations' => true,
                'allow_loan_requests'          => true,
                'allow_loan_repayments'        => true,
                'is_shareout_month'            => ($num === 12),
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);
        }

        // ──────────────────────────────────────────────────────
        // 10. SHARE DECLARATIONS (monthly investments)
        //     Data from InfraCash "Shares" sheet — TOTAL column
        //     (shares × K200)
        // ──────────────────────────────────────────────────────
        //                        Nov    Dec    Jan    Feb    Mar    Apr    May    Jun    Jul    Aug
        $shareData = [
            'Abigail Mundia'  => [200,   15000, 200,   200,   10000, 200,   200,   200,   200,   1000],
            'Abel Kunda'      => [0,     0,     0,     0,     48000, 200,   200,   200,   200,   200],
            'Andrew Chola'    => [1200,  200,   200,   200,   3000,  200,   200,   200,   200,   200],
            'Arthur Mbewe'    => [200,   200,   400,   200,   400,   400,   1000,  3000,  200,   200],
            'Evans Banda'     => [5000,  200,   2000,  200,   200,   2000,  200,   200,   200,   200],
            'Jesper Lungu'    => [200,   200,   200,   200,   200,   200,   200,   400,   200,   200],
            'Joshua Tembo'    => [200,   200,   200,   200,   200,   200,   200,   10000, 1000,  1000],
            'Kampamba Mwale'  => [400,   400,   1200,  400,   400,   3600,  200,   200,   200,   400],
            'Karen Mwinga'    => [1000,  200,   200,   200,   1000,  200,   1000,  1000,  200,   200],
            'Keji Phiri'      => [200,   200,   200,   4800,  200,   200,   200,   200,   200,   200],
            'Kombe Musonda'   => [200,   200,   200,   200,   15000, 200,   15000, 400,   200,   200],
            'Khucwayo Mulenga'=> [200,   400,   200,   200,   200,   200,   200,   400,   1000,  200],
            'Kwibisa Kalumba' => [5000,  200,   200,   200,   200,   200,   1000,  200,   200,   200],
            'Michael Zulu'    => [5000,  5000,  5000,  5000,  10000, 5000,  5000,  5000,  3600,  200],
            'Millie Bwalya'   => [600,   200,   400,   600,   200,   200,   600,   400,   200,   200],
            'Mukuma Chilufya' => [3000,  3000,  5000,  1000,  3400,  1000,  1000,  2600,  2600,  2600],
            'Mumba Kapasa'    => [1000,  1000,  6000,  4000,  7000,  200,   1000,  2000,  2000,  1000],
            'Mumbi Chanda'    => [1000,  2000,  4000,  13000, 5000,  200,   1000,  400,   200,   200],
            'Mwenya Sakala'   => [0,     1000,  1800,  8800,  20000, 400,   1000,  200,   400,   200],
            'Nyanyiwe Tembo'  => [6000,  10000, 2000,  200,   5000,  200,   1000,  200,   200,   200],
            'Pamela Mwansa'   => [200,   1000,  1000,  200,   10000, 200,   1000,  200,   200,   200],
            'Schuller Katongo'=> [5000,  10000, 1000,  5000,  5000,  1000,  1000,  2000,  2000,  200],
            'Shubart Nyimbili'=> [5000,  1000,  1000,  2000,  1000,  200,   200,   0,     200,   400],
            'Solomon Banda'   => [2000,  4000,  1000,  200,   200,   400,   600,   600,   200,   200],
            'Tumelo Ngosa'    => [200,   0,     0,     0,     0,     0,     0,     0,     0,     0],
        ];

        $months = ['Nov','Dec','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug'];

        foreach ($shareData as $name => $amounts) {
            $uid = $userIds[$name];
            foreach ($amounts as $mi => $amount) {
                if ($amount > 0) {
                    $monthLabel = $months[$mi];
                    DB::table('share_declarations')->insert([
                        'user_id'    => $uid,
                        'month_id'   => $monthMap[$monthLabel],
                        'amount'     => $amount,
                        'created_at' => Carbon::parse($monthLabels[$mi + 1][1])->addDays(rand(1, 25)),
                        'updated_at' => $now,
                    ]);
                }
            }
        }

        // ──────────────────────────────────────────────────────
        // 11. INSURANCE CONTRIBUTIONS
        //     K200 fixed per member per month (when shares > 0)
        // ──────────────────────────────────────────────────────
        foreach ($shareData as $name => $amounts) {
            $uid = $userIds[$name];
            foreach ($amounts as $mi => $amount) {
                if ($amount > 0) {
                    $monthLabel = $months[$mi];
                    DB::table('insurance_contributions')->insert([
                        'user_id'    => $uid,
                        'month_id'   => $monthMap[$monthLabel],
                        'amount'     => 200.00,
                        'created_at' => Carbon::parse($monthLabels[$mi + 1][1])->addDays(rand(1, 25)),
                        'updated_at' => $now,
                    ]);
                }
            }
        }

        // ──────────────────────────────────────────────────────
        // 12. LOANS
        //     From "Loan Applicants" sheet.
        //     interest_rate = 10% flat service fee (new loan)
        //     Monthly 5% reducing balance applied on repayment
        // ──────────────────────────────────────────────────────
        $loanData = [
            'Abigail Mundia'   => ['Dec' => 44800, 'Mar' => 50000, 'May' => 3429],
            'Abel Kunda'       => ['Jun' => 14025, 'Jul' => 26090],
            'Andrew Chola'     => ['Nov' => 6400, 'Mar' => 24000, 'May' => 8000],
            'Arthur Mbewe'     => ['Jun' => 17000],
            'Evans Banda'      => ['Nov' => 20000, 'Dec' => 11340, 'Apr' => 9968, 'May' => 5300, 'Jul' => 10000],
            'Jesper Lungu'     => [],
            'Joshua Tembo'     => ['Jan' => 3400, 'Aug' => 11000],
            'Kampamba Mwale'   => ['Nov' => 600, 'Apr' => 17500],
            'Karen Mwinga'     => ['Jan' => 11300, 'Jun' => 50000],
            'Keji Phiri'       => ['Nov' => 6100, 'Feb' => 21000],
            'Kombe Musonda'    => ['Dec' => 6000, 'Jan' => 8750, 'Mar' => 50000, 'May' => 55000],
            'Khucwayo Mulenga' => ['Jan' => 1400],
            'Kwibisa Kalumba'  => ['Nov' => 15000, 'Dec' => 3500, 'Jan' => 2800, 'Apr' => 8000],
            'Michael Zulu'     => ['Apr' => 15000],
            'Millie Bwalya'    => ['Jan' => 10000, 'Jun' => 10000],
            'Mukuma Chilufya'  => ['Jan' => 3000, 'Apr' => 10000],
            'Mumba Kapasa'     => ['Mar' => 10000],
            'Mumbi Chanda'     => ['Dec' => 3000, 'Jan' => 3000, 'May' => 5000],
            'Mwenya Sakala'    => ['Jul' => 15000],
            'Nyanyiwe Tembo'   => ['Feb' => 51300],
            'Pamela Mwansa'    => ['Mar' => 30000],
            'Schuller Katongo' => ['Jul' => 25000],
            'Shubart Nyimbili' => ['Mar' => 13265],
            'Solomon Banda'    => ['Aug' => 15000],
        ];

        foreach ($loanData as $name => $loans) {
            if (empty($loans)) continue;
            $uid = $userIds[$name];

            foreach ($loans as $monthLabel => $amount) {
                $interestRate  = 10.00; // 10% service fee
                $totalPayable  = $amount * 1.10;
                $monthId       = $monthMap[$monthLabel];

                DB::table('loans')->insert([
                    'borrower_id'         => $uid,
                    'month_id'            => $monthId,
                    'amount'              => $amount,
                    'interest_rate'       => $interestRate,
                    'duration'            => 1,
                    'total_payable'       => $totalPayable,
                    'outstanding_balance' => $totalPayable,
                    'status'              => 'active',
                    'type'                => 'voluntary',
                    'notes'               => "Loan of K{$amount} in {$monthLabel} — 10% service fee",
                    'created_at'          => Carbon::parse($monthLabels[array_search($monthLabel, $months) + 1][1])->addDays(rand(5, 20)),
                    'updated_at'          => $now,
                ]);
            }
        }

        // ──────────────────────────────────────────────────────
        // 13. REPAYMENTS (sample repayments from "Repayment Schedule")
        //     Nov loans: Abigail K20000, Kwibisa K13000
        //     Detailed month-by-month repayments
        // ──────────────────────────────────────────────────────
        // Repayments are complex; we insert representative samples
        // from the "Repayment Schedule" sheet for a few key borrowers.

        // Get loan IDs for repayment insertion
        $this->insertRepayments($userIds, $monthMap, $now);

        $this->command->info('✓ InfraCash 2025 village bank seeded with 25 members, shares, insurance & loans.');
    }

    /**
     * Insert representative repayments from the Repayment Schedule sheet.
     */
    private function insertRepayments(array $userIds, array $monthMap, Carbon $now): void
    {
        // Map month labels to actual start dates for repayment timestamps
        $monthStartDates = [
            'Nov' => '2024-11-01', 'Dec' => '2024-12-01',
            'Jan' => '2025-01-01', 'Feb' => '2025-02-01',
            'Mar' => '2025-03-01', 'Apr' => '2025-04-01',
            'May' => '2025-05-01', 'Jun' => '2025-06-01',
            'Jul' => '2025-07-01', 'Aug' => '2025-08-01',
            'Sep' => '2025-09-01', 'Oct' => '2025-10-01',
        ];
        // Repayment data: [borrower, loan_month, [repayment_month => amount_paid]]
        $repaymentData = [
            // Abigail Mundia — Nov loan K20000 (10% fee = K22000 total)
            ['Abigail Mundia', 'Dec', [
                'Dec' => 12000,
                'Jan' => 5500,
                'Feb' => 1250,
                'Mar' => 1200,
                'Apr' => 3150,
            ]],
            // Kwibisa Kalumba — Nov loan K15000
            ['Kwibisa Kalumba', 'Nov', [
                'Dec' => 1500,
                'Jan' => 3000,
                'Feb' => 1500,
                'Mar' => 1500,
                'Apr' => 1500,
                'May' => 1500,
                'Jun' => 6000,
            ]],
            // Evans Banda — Nov loan K20000
            ['Evans Banda', 'Nov', [
                'Dec' => 2000,
                'Jan' => 2000,
                'Feb' => 2000,
                'Mar' => 2000,
                'Apr' => 5000,
                'May' => 3000,
                'Jun' => 3000,
                'Jul' => 3000,
            ]],
            // Andrew Chola — Nov loan K6400
            ['Andrew Chola', 'Nov', [
                'Dec' => 1000,
                'Jan' => 1000,
                'Feb' => 1000,
                'Mar' => 2000,
                'Apr' => 2040,
            ]],
            // Keji Phiri — Nov loan K6100
            ['Keji Phiri', 'Nov', [
                'Dec' => 1000,
                'Jan' => 1000,
                'Feb' => 1000,
                'Mar' => 1000,
                'Apr' => 1000,
                'May' => 1710,
            ]],
            // Kampamba Mwale — Nov loan K600
            ['Kampamba Mwale', 'Nov', [
                'Dec' => 660,
            ]],
        ];

        foreach ($repaymentData as [$name, $loanMonth, $payments]) {
            $uid = $userIds[$name];
            $loanMonthId = $monthMap[$loanMonth];

            // Find the loan
            $loan = DB::table('loans')
                ->where('borrower_id', $uid)
                ->where('month_id', $loanMonthId)
                ->first();

            if (!$loan) continue;

            $remaining = $loan->total_payable;
            foreach ($payments as $repMonth => $amountPaid) {
                $remaining = max(0, $remaining - $amountPaid);
                DB::table('repayments')->insert([
                    'loan_id'           => $loan->id,
                    'amount_paid'       => $amountPaid,
                    'remaining_balance' => $remaining,
                    'penalty_applied'   => 0,
                    'created_at'        => Carbon::parse($monthStartDates[$repMonth])->addDays(rand(1, 25)),
                    'updated_at'        => $now,
                ]);
            }

            // Update loan outstanding balance
            DB::table('loans')
                ->where('id', $loan->id)
                ->update([
                    'outstanding_balance' => $remaining,
                    'status'              => $remaining <= 0 ? 'completed' : 'active',
                ]);
        }
    }
}
