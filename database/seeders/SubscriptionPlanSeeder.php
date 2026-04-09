<?php

namespace Database\Seeders;

use App\Models\Subscription\SubscriptionPlan;
use Illuminate\Database\Seeder;

/**
 * Seeds default subscription plans for the platform.
 *
 * Usage:
 *   php artisan db:seed --class=SubscriptionPlanSeeder
 */
class SubscriptionPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name'          => 'Starter',
                'slug'          => 'starter',
                'description'   => 'Perfect for small savings groups just getting started. Manage one circle with up to 15 members.',
                'price'         => 150.00,
                'billing_cycle' => 'monthly',
                'duration_days' => 30,
                'max_circles'   => 1,
                'max_members'   => 15,
                'features'      => [
                    'Share declarations & tracking',
                    'Basic loan management',
                    'Payment uploads',
                    'Monthly reports',
                ],
                'is_active'     => true,
                'sort_order'    => 1,
                'is_featured'   => false,
            ],
            [
                'name'          => 'Growth',
                'slug'          => 'growth',
                'description'   => 'For growing village banks with multiple circles. Full financial management and reporting.',
                'price'         => 350.00,
                'billing_cycle' => 'monthly',
                'duration_days' => 30,
                'max_circles'   => 5,
                'max_members'   => 50,
                'features'      => [
                    'Everything in Starter',
                    'Up to 5 circles',
                    'Insurance management',
                    'Loan pairing & approvals',
                    'Shareout calculations',
                    'Rules & bylaws module',
                    'Polls & voting',
                    'Export reports (PDF/Excel)',
                ],
                'is_active'     => true,
                'sort_order'    => 2,
                'is_featured'   => true,
            ],
            [
                'name'          => 'Community',
                'slug'          => 'community',
                'description'   => 'Unlimited circles and members. Full platform access for large community banking operations.',
                'price'         => 750.00,
                'billing_cycle' => 'monthly',
                'duration_days' => 30,
                'max_circles'   => null,  // unlimited
                'max_members'   => null,  // unlimited
                'features'      => [
                    'Everything in Growth',
                    'Unlimited circles',
                    'Unlimited members',
                    'Priority support',
                    'Custom branding',
                    'Advanced analytics',
                    'Multi-admin management',
                ],
                'is_active'     => true,
                'sort_order'    => 3,
                'is_featured'   => false,
            ],
            [
                'name'          => 'Starter Annual',
                'slug'          => 'starter-annual',
                'description'   => 'Starter plan billed annually — save 2 months!',
                'price'         => 1500.00,
                'billing_cycle' => 'yearly',
                'duration_days' => 365,
                'max_circles'   => 1,
                'max_members'   => 15,
                'features'      => [
                    'Share declarations & tracking',
                    'Basic loan management',
                    'Payment uploads',
                    'Monthly reports',
                    '2 months free (annual billing)',
                ],
                'is_active'     => true,
                'sort_order'    => 4,
                'is_featured'   => false,
            ],
            [
                'name'          => 'Growth Annual',
                'slug'          => 'growth-annual',
                'description'   => 'Growth plan billed annually — save 2 months!',
                'price'         => 3500.00,
                'billing_cycle' => 'yearly',
                'duration_days' => 365,
                'max_circles'   => 5,
                'max_members'   => 50,
                'features'      => [
                    'Everything in Starter',
                    'Up to 5 circles',
                    'Insurance management',
                    'Loan pairing & approvals',
                    'Shareout calculations',
                    'Rules & bylaws module',
                    'Polls & voting',
                    'Export reports (PDF/Excel)',
                    '2 months free (annual billing)',
                ],
                'is_active'     => true,
                'sort_order'    => 5,
                'is_featured'   => false,
            ],
            [
                'name'          => 'Community Annual',
                'slug'          => 'community-annual',
                'description'   => 'Community plan billed annually — save 2 months!',
                'price'         => 7500.00,
                'billing_cycle' => 'yearly',
                'duration_days' => 365,
                'max_circles'   => null,
                'max_members'   => null,
                'features'      => [
                    'Everything in Growth',
                    'Unlimited circles',
                    'Unlimited members',
                    'Priority support',
                    'Custom branding',
                    'Advanced analytics',
                    'Multi-admin management',
                    '2 months free (annual billing)',
                ],
                'is_active'     => true,
                'sort_order'    => 6,
                'is_featured'   => false,
            ],
        ];

        $created = 0;
        $skipped = 0;

        foreach ($plans as $plan) {
            $record = SubscriptionPlan::firstOrCreate(
                ['slug' => $plan['slug']],
                $plan
            );

            $record->wasRecentlyCreated ? $created++ : $skipped++;
        }

        $this->command->info("Subscription plans seeded: {$created} created, {$skipped} already existed.");
    }
}
