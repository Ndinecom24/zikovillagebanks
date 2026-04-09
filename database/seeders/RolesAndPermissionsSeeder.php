<?php

namespace Database\Seeders;

use App\Models\RoleBasedAccess\Permission;
use App\Models\RoleBasedAccess\Role;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // ===== PERMISSIONS (driven by config/chilolezo.php) =====
        $groups = config('chilolezo.permissions', []);

        foreach ($groups as $section) {
            $group = $section['group'];
            foreach ($section['items'] ?? [] as $slug => $description) {
                Permission::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name'        => ucwords(str_replace('-', ' ', $slug)),
                        'slug'        => $slug,
                        'description' => $description,
                        'group'       => $group,
                    ]
                );
            }
        }

        // ===== ROLES =====
        $rolesData = [
            'super-admin'      => ['name' => 'Super Admin',      'description' => 'Ndinecom platform super administrator — full system access'],
            'chairperson'      => ['name' => 'Chairperson',      'description' => 'Circle chairperson — full village bank admin access'],
            'secretary'        => ['name' => 'Secretary',         'description' => 'Records, member management, monthly cycles'],
            'treasurer'        => ['name' => 'Treasurer',         'description' => 'Financial operations — shares, loans, payments'],
            'committee-member' => ['name' => 'Committee Member',  'description' => 'Loan approvals and oversight'],
            'member'           => ['name' => 'Member',            'description' => 'Regular circle member'],
        ];

        $roles = [];
        foreach ($rolesData as $slug => $data) {
            $roles[$slug] = Role::firstOrCreate(
                ['slug' => $slug],
                array_merge(['slug' => $slug], $data)
            );
        }

        // ===== ROLE → PERMISSION MAPPING (driven by config) =====
        $mappings = config('chilolezo.role_permissions', []);

        foreach ($mappings as $roleSlug => $permSlugs) {
            if (! isset($roles[$roleSlug])) {
                continue;
            }

            if ($permSlugs === 'all') {
                $roles[$roleSlug]->permissions()->sync(Permission::pluck('id'));
            } else {
                $ids = Permission::whereIn('slug', $permSlugs)->pluck('id');
                $roles[$roleSlug]->permissions()->sync($ids);
            }
        }

        $this->command->info('Roles & permissions seeded from config/chilolezo.php ✓');
    }
}
