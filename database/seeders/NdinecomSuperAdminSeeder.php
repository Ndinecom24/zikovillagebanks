<?php

namespace Database\Seeders;

use App\Models\RoleBasedAccess\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


/**
 * Seeds the Ndinecom platform super-admin user.
 *
 * This user has the 'super-admin' role and full access to the entire platform,
 * including subscription management, license management, and application review.
 *
 * Usage:
 *   php artisan db:seed --class=NdinecomSuperAdminSeeder
 */
class NdinecomSuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create the Ndinecom super-admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@ndinecom.com'],
            [
                'name'             => 'Ndinecom Admin',
                'username'         => 'NDC-001',
                'email'            => 'admin@ndinecom.com',
                'job_title'        => 'Platform Administrator',
                'user_unit'        => 'Technology',
                'directorate'      => 'Ndinecom',
                'mobile_no'        => '+260977000001',
                'phone'            => '+260211000001',
                'user_role_id'     => '1',
                'password'         => Hash::make('Ndinecom@2026'),
                'usertype'         => config('constants.user_types.admin', 1),
                'status'           => 'active',
                'email_verified_at' => now(),
            ]
        );

        // Assign super-admin role
        $superAdminRole = Role::where('slug', 'super-admin')->first();

        if ($superAdminRole && !$admin->hasRole('super-admin')) {
            $admin->assignRole($superAdminRole);
        }

        $this->command->info('Ndinecom Super Admin seeded:');
        $this->command->info("  Email:    admin@ndinecom.com");
        $this->command->info("  Password: Ndinecom@2026");
        $this->command->newLine();
    }
}
