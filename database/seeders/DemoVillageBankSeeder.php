<?php

namespace Database\Seeders;

use App\Models\RoleBasedAccess\Role;
use App\Models\Subscription\License;
use App\Models\Subscription\Subscription;
use App\Models\Subscription\SubscriptionPlan;
use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Seeds a demo Village Bank with members, circles, and an active subscription/license
 * so the system can be explored immediately after setup.
 *
 * Usage:
 *   php artisan db:seed --class=DemoVillageBankSeeder
 */
class DemoVillageBankSeeder extends Seeder
{
    public function run(): void
    {
        $defaultPassword = Hash::make('password');

        // ─── Ensure the Ndinecom super-admin exists ──────────────
        $superAdmin = User::where('email', 'admin@ndinecom.com')->first();
        if (!$superAdmin) {
            $this->command->warn('Super-admin not found. Run NdinecomSuperAdminSeeder first.');
            return;
        }

        // ─── 1. Create demo Village Bank ─────────────────────────
        $bank = VillageBank::firstOrCreate(
            ['code' => 'DEMO-VB-001'],
            [
                'name'        => 'Lusaka Community Savings',
                'code'        => 'DEMO-VB-001',
                'description' => 'A demo village bank for testing the platform. Based in Lusaka.',
                'address'     => 'Plot 123, Great East Road, Lusaka',
                'phone'       => '+260977100001',
                'email'       => 'lusaka.savings@demo.com',
                'status'      => 'active',
                'created_by'  => $superAdmin->id,
            ]
        );

        $this->command->info("Village Bank: {$bank->name} ({$bank->code})");

        // ─── 2. Create demo users ────────────────────────────────
        $demoUsers = [
            [
                'name'        => 'Grace Mwanza',
                'username'    => 'VB-001',
                'email'       => 'grace@demo.com',
                'job_title'   => 'Chairperson',
                'mobile_no'   => '+260977200001',
                'role_slug'   => 'chairperson',
                'bank_role'   => 'admin',
            ],
            [
                'name'        => 'Joseph Banda',
                'username'    => 'VB-002',
                'email'       => 'joseph@demo.com',
                'job_title'   => 'Secretary',
                'mobile_no'   => '+260977200002',
                'role_slug'   => 'secretary',
                'bank_role'   => 'admin',
            ],
            [
                'name'        => 'Mary Phiri',
                'username'    => 'VB-003',
                'email'       => 'mary@demo.com',
                'job_title'   => 'Treasurer',
                'mobile_no'   => '+260977200003',
                'role_slug'   => 'treasurer',
                'bank_role'   => 'admin',
            ],
            [
                'name'        => 'Peter Tembo',
                'username'    => 'VB-004',
                'email'       => 'peter@demo.com',
                'job_title'   => 'Committee Member',
                'mobile_no'   => '+260977200004',
                'role_slug'   => 'committee-member',
                'bank_role'   => 'member',
            ],
            [
                'name'        => 'Charity Zulu',
                'username'    => 'VB-005',
                'email'       => 'charity@demo.com',
                'job_title'   => 'Member',
                'mobile_no'   => '+260977200005',
                'role_slug'   => 'member',
                'bank_role'   => 'member',
            ],
            [
                'name'        => 'Moses Mumba',
                'username'    => 'VB-006',
                'email'       => 'moses@demo.com',
                'job_title'   => 'Member',
                'mobile_no'   => '+260977200006',
                'role_slug'   => 'member',
                'bank_role'   => 'member',
            ],
            [
                'name'        => 'Esther Chilufya',
                'username'    => 'VB-007',
                'email'       => 'esther@demo.com',
                'job_title'   => 'Member',
                'mobile_no'   => '+260977200007',
                'role_slug'   => 'member',
                'bank_role'   => 'member',
            ],
            [
                'name'        => 'David Mulenga',
                'username'    => 'VB-008',
                'email'       => 'david@demo.com',
                'job_title'   => 'Member',
                'mobile_no'   => '+260977200008',
                'role_slug'   => 'member',
                'bank_role'   => 'member',
            ],
            [
                'name'        => 'Agnes Chanda',
                'username'    => 'VB-009',
                'email'       => 'agnes@demo.com',
                'job_title'   => 'Member',
                'mobile_no'   => '+260977200009',
                'role_slug'   => 'member',
                'bank_role'   => 'member',
            ],
            [
                'name'        => 'James Sakala',
                'username'    => 'VB-010',
                'email'       => 'james@demo.com',
                'job_title'   => 'Member',
                'mobile_no'   => '+260977200010',
                'role_slug'   => 'member',
                'bank_role'   => 'member',
            ],
        ];

        $createdUsers = [];

        foreach ($demoUsers as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name'              => $userData['name'],
                    'username'          => $userData['username'],
                    'email'             => $userData['email'],
                    'job_title'         => $userData['job_title'],
                    'user_unit'         => 'Village Banking',
                    'directorate'       => 'Lusaka Community Savings',
                    'mobile_no'         => $userData['mobile_no'],
                    'user_role_id'      => '2',
                    'password'          => $defaultPassword,
                    'usertype'          => config('constants.user_types.normal', 2),
                    'status'            => 'active',
                    'email_verified_at' => now(),
                ]
            );

            // Assign circle role
            $role = Role::where('slug', $userData['role_slug'])->first();
            if ($role && !$user->hasRole($userData['role_slug'])) {
                $user->assignRole($role);
            }

            // Attach to village bank
            VillageBankMember::firstOrCreate(
                ['village_bank_id' => $bank->id, 'user_id' => $user->id],
                [
                    'village_bank_id' => $bank->id,
                    'user_id'         => $user->id,
                    'role'            => $userData['bank_role'],
                    'joined_at'       => now(),
                ]
            );

            $createdUsers[] = $user;
            $this->command->info("  User: {$user->name} ({$user->email}) — {$userData['role_slug']}");
        }

        // ─── 3. Create a demo circle ─────────────────────────────
        $circle = Circle::firstOrCreate(
            ['name' => 'Tiyende Pamodzi', 'village_bank_id' => $bank->id],
            [
                'name'            => 'Tiyende Pamodzi',
                'village_bank_id' => $bank->id,
                'duration_months' => 12,
                'start_date'      => now()->startOfMonth(),
                'end_date'        => now()->addMonths(12)->endOfMonth(),
                'status'          => 'active',
                'created_by'      => $createdUsers[0]->id, // chairperson
            ]
        );

        // Attach all demo users to the circle
        foreach ($createdUsers as $user) {
            if (!$circle->members()->where('user_id', $user->id)->exists()) {
                $circle->members()->attach($user->id, ['joined_at' => now()]);
            }
        }

        $this->command->info("  Circle: {$circle->name} — {$circle->members()->count()} members");

        // ─── 4. Create active subscription & license ─────────────
        $plan = SubscriptionPlan::where('slug', 'growth')->first();
        if (!$plan) {
            $plan = SubscriptionPlan::first();
        }

        if ($plan) {
            $subscription = Subscription::firstOrCreate(
                ['village_bank_id' => $bank->id, 'subscription_plan_id' => $plan->id, 'status' => 'active'],
                [
                    'village_bank_id'      => $bank->id,
                    'subscription_plan_id' => $plan->id,
                    'status'               => 'active',
                    'starts_at'            => now(),
                    'ends_at'              => now()->addDays($plan->duration_days),
                    'auto_renew'           => false,
                ]
            );

            $license = License::firstOrCreate(
                ['village_bank_id' => $bank->id, 'subscription_id' => $subscription->id],
                [
                    'village_bank_id'  => $bank->id,
                    'subscription_id'  => $subscription->id,
                    'license_key'      => 'VB-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4)),
                    'status'           => 'active',
                    'issued_at'        => now(),
                    'expires_at'       => now()->addDays($plan->duration_days),
                ]
            );

            $this->command->info("  Subscription: {$plan->name} (active) — License: {$license->license_key}");
        }

        $this->command->newLine();
        $this->command->info('Demo Village Bank seeded successfully!');
        $this->command->info('All demo users have password: password');
    }
}
