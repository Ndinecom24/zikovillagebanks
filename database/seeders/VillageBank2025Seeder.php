<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * Seeds Village Bank #2: "Village Bank 2025/2026"
 *
 * Data sourced from: docs/sample-excels-vbank/VILLAGEBANK2025_2026 (1).xlsx
 *
 * Circle runs: February 2025 – January 2026 (12 months)
 * Share unit: K200
 * Insurance: K100/month (fixed)
 * Interest rate: 5% monthly compound (reducing balance) + 10% service fee on new loans
 * Loan eligibility: 3× total invested
 * 12 members
 */
class VillageBank2025Seeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // ──────────────────────────────────────────────────────
        // 1. CREATE ADMIN USER
        // ──────────────────────────────────────────────────────
        $adminId = DB::table('users')->insertGetId([
            'name'       => 'VBank25 Admin',
            'username'   => 'vbank25_admin',
            'email'      => 'admin@vbank25.test',
            'password'   => Hash::make('Password1!'),
            'status'     => 'active',
            'usertype'   => 1,
            'phone'      => '0972000000',
            'mobile_no'  => '0972000000',
            'total_login' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // ──────────────────────────────────────────────────────
        // 2. CREATE MEMBERS (from SHARES sheet)
        // ──────────────────────────────────────────────────────
        $membersInfo = [
            ['name' => 'Shubart Nyimbili',    'phone' => '0979780593'],
            ['name' => 'Peter Njovu',         'phone' => '0978958789'],
            ['name' => 'Jailos Daka',         'phone' => '0973097114'],
            ['name' => 'Gabriel Nyimbili',    'phone' => '0974498509'],
            ['name' => 'Daniel Banda',        'phone' => '0978647507'],
            ['name' => 'Faides Nyimbili',     'phone' => '0971817434'],
            ['name' => 'Clera Mashonga',      'phone' => '0977516128'],
            ['name' => 'Maureen Daka',        'phone' => '0976663626'],
            ['name' => 'Lesa Chisanga',       'phone' => '0973274443'],
            ['name' => 'Michelle Nangandu',   'phone' => '0971585569'],
            ['name' => 'Rosemary Kalikoga',   'phone' => '0773472923'],
            ['name' => 'Osward Mwansa',       'phone' => '0976941466'],
        ];

        $userIds = [];
        foreach ($membersInfo as $member) {
            $slug = strtolower(str_replace(' ', '.', $member['name']));
            $userIds[$member['name']] = DB::table('users')->insertGetId([
                'name'       => $member['name'],
                'username'   => 'vb_' . $slug,
                'email'      => $slug . '@vbank25.test',
                'password'   => Hash::make('Password1!'),
                'status'     => 'active',
                'usertype'   => 2,
                'phone'      => $member['phone'],
                'mobile_no'  => $member['phone'],
                'total_login' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // ──────────────────────────────────────────────────────
        // 3. CREATE VILLAGE BANK
        // ──────────────────────────────────────────────────────
        $bankId = DB::table('village_banks')->insertGetId([
            'name'        => 'Village Bank 2025/2026',
            'code'        => 'VBANK2526',
            'description' => 'Village Bank — February 2025 to January 2026 cycle. 12 members. Share unit K200, insurance K100, 5% monthly compound interest, 10% service fee on loans.',
            'status'      => 'active',
            'created_by'  => $adminId,
            'created_at'  => $now,
            'updated_at'  => $now,
        ]);

        // ──────────────────────────────────────────────────────
        // 4. VILLAGE BANK MEMBERS
        // ──────────────────────────────────────────────────────
        DB::table('village_bank_members')->insert([
            'village_bank_id' => $bankId,
            'user_id'         => $adminId,
            'role'            => 'admin',
            'joined_at'       => Carbon::parse('2025-01-15'),
            'created_at'      => $now,
            'updated_at'      => $now,
        ]);
        foreach ($userIds as $uid) {
            DB::table('village_bank_members')->insert([
                'village_bank_id' => $bankId,
                'user_id'         => $uid,
                'role'            => 'member',
                'joined_at'       => Carbon::parse('2025-01-20'),
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);
        }

        // ──────────────────────────────────────────────────────
        // 5. VILLAGE BANK CONFIGURATION
        // ──────────────────────────────────────────────────────
        DB::table('village_bank_configurations')->insert([
            'village_bank_id'             => $bankId,
            'circle_duration_months'      => 12,
            'share_unit_amount'           => 200.00,
            'min_shares_per_month'        => 1,
            'max_shares_per_month'        => 50,
            'insurance_type'              => 'fixed',
            'insurance_value'             => 100.00,
            'max_loan_multiplier'         => 3,
            'default_interest_rate'       => 10.00,  // 10% service fee on new loans
            'interest_type'               => 'reducing_balance',
            'reducing_balance_rate'       => 5.00,   // 5% monthly compound
            'default_loan_duration'       => 1,
            'allow_multiple_active_loans' => false,
            'late_repayment_penalty_rate' => 5.00,
            'grace_period_days'           => 0,
            'created_at'                  => $now,
            'updated_at'                  => $now,
        ]);

        // ──────────────────────────────────────────────────────
        // 6. CIRCLE
        // ──────────────────────────────────────────────────────
        $circleId = DB::table('circles')->insertGetId([
            'village_bank_id' => $bankId,
            'name'            => 'VBank Cycle 2025/2026',
            'duration_months' => 12,
            'start_date'      => '2025-02-01',
            'end_date'        => '2026-01-31',
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
            'joined_at' => Carbon::parse('2025-01-15'),
        ]);
        foreach ($userIds as $uid) {
            DB::table('circle_members')->insert([
                'circle_id' => $circleId,
                'user_id'   => $uid,
                'joined_at' => Carbon::parse('2025-01-20'),
            ]);
        }

        // ──────────────────────────────────────────────────────
        // 8. INSURANCE CONFIG
        // ──────────────────────────────────────────────────────
        DB::table('insurance_configs')->insert([
            'circle_id'  => $circleId,
            'type'       => 'fixed',
            'value'      => 100.00,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // ──────────────────────────────────────────────────────
        // 9. MONTHS (Feb 2025 – Jan 2026)
        // ──────────────────────────────────────────────────────
        $monthMap = [];
        $monthDefs = [
            1  => ['Feb', '2025-02-01', '2025-02-28'],
            2  => ['Mar', '2025-03-01', '2025-03-31'],
            3  => ['Apr', '2025-04-01', '2025-04-30'],
            4  => ['May', '2025-05-01', '2025-05-31'],
            5  => ['Jun', '2025-06-01', '2025-06-30'],
            6  => ['Jul', '2025-07-01', '2025-07-31'],
            7  => ['Aug', '2025-08-01', '2025-08-31'],
            8  => ['Sep', '2025-09-01', '2025-09-30'],
            9  => ['Oct', '2025-10-01', '2025-10-31'],
            10 => ['Nov', '2025-11-01', '2025-11-30'],
            11 => ['Dec', '2025-12-01', '2025-12-31'],
            12 => ['Jan26', '2026-01-01', '2026-01-31'],
        ];

        foreach ($monthDefs as $num => [$label, $start, $end]) {
            $monthMap[$label] = DB::table('months')->insertGetId([
                'circle_id'    => $circleId,
                'month_number' => $num,
                'label'        => $label,
                'start_date'   => $start,
                'end_date'     => $end,
                'status'       => ($num <= 9) ? 'closed' : 'pending',
                'allow_share_declarations'     => true,
                'allow_insurance_declarations' => true,
                'allow_loan_requests'          => true,
                'allow_loan_repayments'        => true,
                'is_shareout_month'            => ($num === 12),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // ──────────────────────────────────────────────────────
        // 10. SHARE DECLARATIONS
        //     From SHARES sheet: INVESTED column per month block
        //     Each month block: insurance(col), invested(col+1), ...
        // ──────────────────────────────────────────────────────
        //                               Feb   Mar   Apr   May   Jun   Jul   Aug   Sep   Oct
        $shareData = [
            'Shubart Nyimbili'  => [200,  400,  200,  200,  200,  200,  0,    0,    200],
            'Peter Njovu'       => [500,  400,  400,  200,  400,  600,  400,  600,  400],
            'Jailos Daka'       => [200,  200,  200,  200,  200,  200,  400,  200,  200],
            'Gabriel Nyimbili'  => [0,    200,  200,  200,  200,  400,  500,  400,  400],
            'Daniel Banda'      => [200,  200,  200,  200,  200,  400,  200,  200,  200],
            'Faides Nyimbili'   => [200,  200,  0,    200,  200,  200,  200,  0,    200],
            'Clera Mashonga'    => [200,  200,  200,  200,  200,  200,  200,  0,    0],
            'Maureen Daka'      => [0,    0,    200,  800,  400,  0,    0,    0,    400],
            'Lesa Chisanga'     => [0,    200,  0,    200,  200,  200,  200,  200,  200],
            'Michelle Nangandu' => [0,    0,    0,    0,    1000, 200,  0,    0,    0],
            'Rosemary Kalikoga' => [0,    0,    0,    0,    200,  200,  200,  0,    200],
            'Osward Mwansa'     => [0,    0,    0,    0,    0,    0,    0,    0,    200],
        ];

        $monthLabels = ['Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct'];

        foreach ($shareData as $name => $amounts) {
            $uid = $userIds[$name];
            foreach ($amounts as $mi => $amount) {
                if ($amount > 0) {
                    $label = $monthLabels[$mi];
                    DB::table('share_declarations')->insert([
                        'user_id'    => $uid,
                        'month_id'   => $monthMap[$label],
                        'amount'     => $amount,
                        'created_at' => Carbon::parse($monthDefs[$mi + 1][1])->addDays(rand(1, 20)),
                        'updated_at' => $now,
                    ]);
                }
            }
        }

        // ──────────────────────────────────────────────────────
        // 11. INSURANCE CONTRIBUTIONS
        //     K100/month (from INSURANCE column in SHARES sheet)
        // ──────────────────────────────────────────────────────
        //                               Feb   Mar   Apr   May   Jun   Jul   Aug   Sep   Oct
        $insuranceData = [
            'Shubart Nyimbili'  => [100,  100,  100,  100,  100,  100,  0,    0,    100],
            'Peter Njovu'       => [100,  100,  100,  100,  100,  100,  100,  100,  100],
            'Jailos Daka'       => [100,  100,  100,  100,  100,  100,  100,  100,  100],
            'Gabriel Nyimbili'  => [0,    100,  100,  100,  100,  100,  100,  100,  100],
            'Daniel Banda'      => [100,  100,  100,  100,  100,  100,  100,  100,  100],
            'Faides Nyimbili'   => [100,  100,  0,    100,  100,  100,  100,  0,    100],
            'Clera Mashonga'    => [100,  100,  100,  100,  100,  100,  100,  0,    100],
            'Maureen Daka'      => [0,    0,    100,  100,  100,  100,  0,    0,    100],
            'Lesa Chisanga'     => [0,    100,  0,    100,  100,  100,  100,  100,  100],
            'Michelle Nangandu' => [0,    0,    0,    0,    100,  100,  0,    0,    100],
            'Rosemary Kalikoga' => [0,    0,    0,    0,    100,  100,  100,  0,    100],
            'Osward Mwansa'     => [0,    0,    0,    0,    0,    0,    0,    0,    100],
        ];

        foreach ($insuranceData as $name => $amounts) {
            $uid = $userIds[$name];
            foreach ($amounts as $mi => $amount) {
                if ($amount > 0) {
                    $label = $monthLabels[$mi];
                    DB::table('insurance_contributions')->insert([
                        'user_id'    => $uid,
                        'month_id'   => $monthMap[$label],
                        'amount'     => $amount,
                        'created_at' => Carbon::parse($monthDefs[$mi + 1][1])->addDays(rand(1, 20)),
                        'updated_at' => $now,
                    ]);
                }
            }
        }

        // ──────────────────────────────────────────────────────
        // 12. LOANS
        //     From SHARES sheet "LOAN" column and LOAN BALANCES sheet
        //     Loan amounts per month with 10% service fee
        // ──────────────────────────────────────────────────────
        $loanData = [
            // name => [month_label => amount]
            'Shubart Nyimbili'  => ['Mar' => 1100, 'Oct' => 7556.61],
            'Peter Njovu'       => [],
            'Jailos Daka'       => ['Apr' => 1000, 'Jul' => 1500, 'Sep' => 500],
            'Gabriel Nyimbili'  => ['Mar' => 1000],
            'Daniel Banda'      => ['Feb' => 800, 'Jun' => 2000, 'Sep' => 2300],
            'Faides Nyimbili'   => ['Feb' => 1000, 'Aug' => 3000],
            'Clera Mashonga'    => ['Apr' => 1800, 'Jun' => 1528, 'Aug' => 3151.45],
            'Maureen Daka'      => ['May' => 3900, 'Jun' => 1300],
            'Lesa Chisanga'     => ['Mar' => 900, 'May' => 580, 'Jul' => 3000, 'Sep' => 500],
            'Michelle Nangandu' => ['Jun' => 5000],
            'Rosemary Kalikoga' => ['Jul' => 1500],
            'Osward Mwansa'     => [],
        ];

        foreach ($loanData as $name => $loans) {
            if (empty($loans)) continue;
            $uid = $userIds[$name];

            foreach ($loans as $monthLabel => $amount) {
                $interestRate  = 10.00;
                $totalPayable  = round($amount * 1.10, 2);
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
                    'created_at'          => Carbon::parse($monthDefs[array_search($monthLabel, $monthLabels) + 1][1])->addDays(rand(5, 20)),
                    'updated_at'          => $now,
                ]);
            }
        }

        // ──────────────────────────────────────────────────────
        // 13. REPAYMENTS
        //     From SHARES sheet "LOAN REP" column per month
        // ──────────────────────────────────────────────────────
        $repaymentData = [
            // name => [month_label => total_repaid_that_month]
            'Shubart Nyimbili'  => ['Apr' => 200, 'May' => 200, 'Jun' => 200, 'Jul' => 200, 'Oct' => 623.61],
            'Jailos Daka'       => ['May' => 200, 'Jun' => 200, 'Jul' => 200, 'Aug' => 500, 'Sep' => 200, 'Oct' => 200],
            'Gabriel Nyimbili'  => ['Apr' => 200, 'May' => 200, 'Jun' => 500, 'Jul' => 300],
            'Daniel Banda'      => ['Jul' => 400, 'Oct' => 400],
            'Faides Nyimbili'   => ['May' => 200, 'Jun' => 200, 'Jul' => 200, 'Oct' => 700],
            'Clera Mashonga'    => ['May' => 180, 'Jun' => 2528, 'Jul' => 200, 'Aug' => 851.45, 'Oct' => 300],
            'Maureen Daka'      => ['Jun' => 1500, 'Jul' => 200, 'Aug' => 300, 'Oct' => 1000],
            'Lesa Chisanga'     => ['May' => 200, 'Jun' => 200, 'Jul' => 200, 'Aug' => 500, 'Sep' => 200, 'Oct' => 200],
            'Michelle Nangandu' => ['Jul' => 200, 'Sep' => 1000, 'Oct' => 400],
            'Rosemary Kalikoga' => ['Aug' => 500, 'Oct' => 633],
        ];

        foreach ($repaymentData as $name => $payments) {
            $uid = $userIds[$name];

            // Find the first active loan for this member
            $loan = DB::table('loans')
                ->where('borrower_id', $uid)
                ->orderBy('id')
                ->first();

            if (!$loan) continue;

            $remaining = $loan->total_payable;
            foreach ($payments as $repMonth => $amountPaid) {
                $remaining = max(0, round($remaining - $amountPaid, 2));
                DB::table('repayments')->insert([
                    'loan_id'           => $loan->id,
                    'amount_paid'       => $amountPaid,
                    'remaining_balance' => $remaining,
                    'penalty_applied'   => 0,
                    'created_at'        => Carbon::parse($monthDefs[array_search($repMonth, $monthLabels) + 1][1])->addDays(rand(1, 20)),
                    'updated_at'        => $now,
                ]);
            }

            DB::table('loans')
                ->where('id', $loan->id)
                ->update([
                    'outstanding_balance' => $remaining,
                    'status'              => $remaining <= 0 ? 'completed' : 'active',
                ]);
        }

        $this->command->info('✓ Village Bank 2025/2026 seeded with 12 members, shares, insurance & loans.');
    }
}
