<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Run all seeders:   php artisan db:seed
     * Run one seeder:    php artisan db:seed --class=NdinecomSuperAdminSeeder
     * Fresh + seed:      php artisan migrate:fresh --seed
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // 1. Roles & Permissions — must run first (other seeders depend on roles)
            RolesAndPermissionsSeeder::class,

            // 2. Ndinecom platform super-admin (admin@ndinecom.com)
            NdinecomSuperAdminSeeder::class,

            // 3. Subscription plans (Starter, Growth, Community + annual variants)
            SubscriptionPlanSeeder::class,

            // 4. Default payment methods (mobile money + banks)
            PaymentMethodSeeder::class,

            // 5. Demo Village Bank with 10 members, circle, subscription & license
            DemoVillageBankSeeder::class,
        ]);
    }
}
