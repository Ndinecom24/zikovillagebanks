<?php

namespace Database\Seeders;

use App\Models\VillageBanking\PaymentMethod;
use Illuminate\Database\Seeder;

/**
 * Seeds default payment methods available for village bank transactions.
 *
 * Usage:
 *   php artisan db:seed --class=PaymentMethodSeeder
 */
class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            [
                'name'           => 'Airtel Money',
                'type'           => 'mobile_money',
                'account_name'   => null,
                'account_number' => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'MTN Mobile Money',
                'type'           => 'mobile_money',
                'account_name'   => null,
                'account_number' => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'Zamtel Money',
                'type'           => 'mobile_money',
                'account_name'   => null,
                'account_number' => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'Zanaco Bank',
                'type'           => 'bank',
                'account_name'   => null,
                'account_number' => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'FNB Zambia',
                'type'           => 'bank',
                'account_name'   => null,
                'account_number' => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'Stanbic Bank',
                'type'           => 'bank',
                'account_name'   => null,
                'account_number' => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'ABSA Bank',
                'type'           => 'bank',
                'account_name'   => null,
                'account_number' => null,
                'is_active'      => true,
            ],
            [
                'name'           => 'Cash',
                'type'           => 'mobile_money', // general fallback
                'account_name'   => null,
                'account_number' => null,
                'is_active'      => true,
            ],
        ];

        $created = 0;
        $skipped = 0;

        foreach ($methods as $method) {
            $record = PaymentMethod::firstOrCreate(
                ['name' => $method['name']],
                $method
            );

            $record->wasRecentlyCreated ? $created++ : $skipped++;
        }

        $this->command->info("Payment methods seeded: {$created} created, {$skipped} already existed.");
    }
}
