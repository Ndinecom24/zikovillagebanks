<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Master seeder for stress-test village bank data.
 *
 * Seeds TWO complete village banks with real-world data from the
 * sample Excel files in docs/sample-excels-vbank/:
 *
 *  1. InfraCash 2025        — 25 members, Nov 2024 – Oct 2025
 *  2. Village Bank 2025/2026 — 12 members, Feb 2025 – Jan 2026
 *
 * Each bank includes: users, village bank, configuration, circle,
 * circle members, months, share declarations, insurance contributions,
 * loans, and repayments.
 *
 * Usage:
 *   php artisan db:seed --class=StressTestVillageBankSeeder
 *
 * Or add it to DatabaseSeeder if you want it in `migrate:fresh --seed`.
 */
class StressTestVillageBankSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('');
        $this->command->info('══════════════════════════════════════════════');
        $this->command->info('  STRESS TEST: Seeding 2 Village Banks');
        $this->command->info('══════════════════════════════════════════════');

        $this->call([
            InfraCashVillageBankSeeder::class,
            VillageBank2025Seeder::class,
        ]);

        $this->command->info('');
        $this->command->info('══════════════════════════════════════════════');
        $this->command->info('  ✓ Stress test data seeded successfully!');
        $this->command->info('    → InfraCash 2025:         25 members');
        $this->command->info('    → Village Bank 2025/2026: 12 members');
        $this->command->info('══════════════════════════════════════════════');
        $this->command->info('');
    }
}
