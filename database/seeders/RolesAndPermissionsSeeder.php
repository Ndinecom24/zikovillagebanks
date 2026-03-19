<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // ===== PERMISSIONS =====
        $permissions = [
            // IPP Management
            ['name' => 'View IPP', 'group' => 'IPP Management', 'description' => 'View independent power producers'],
            ['name' => 'Create IPP', 'group' => 'IPP Management', 'description' => 'Create new IPP entries'],
            ['name' => 'Edit IPP', 'group' => 'IPP Management', 'description' => 'Edit IPP entries'],
            ['name' => 'Delete IPP', 'group' => 'IPP Management', 'description' => 'Delete IPP entries'],

            // User Management
            ['name' => 'View Users', 'group' => 'User Management', 'description' => 'View user list'],
            ['name' => 'Create Users', 'group' => 'User Management', 'description' => 'Create new users'],
            ['name' => 'Edit Users', 'group' => 'User Management', 'description' => 'Edit user details'],
            ['name' => 'Delete Users', 'group' => 'User Management', 'description' => 'Delete users'],
            ['name' => 'Manage Roles', 'group' => 'User Management', 'description' => 'Manage roles and permissions'],

            // Reports
            ['name' => 'View Reports', 'group' => 'Reports', 'description' => 'View reports'],
            ['name' => 'Export Reports', 'group' => 'Reports', 'description' => 'Export reports to file'],

            // Configuration
            ['name' => 'Manage Statuses', 'group' => 'Configuration', 'description' => 'Manage status configurations'],
            ['name' => 'Manage Technologies', 'group' => 'Configuration', 'description' => 'Manage technology types'],
            ['name' => 'Manage Ventures', 'group' => 'Configuration', 'description' => 'Manage venture types'],
            ['name' => 'Manage Modules', 'group' => 'Configuration', 'description' => 'Manage system modules'],
            ['name' => 'Manage Offices', 'group' => 'Configuration', 'description' => 'Manage responsible offices'],

            // Substations
            ['name' => 'View Substations', 'group' => 'Substations', 'description' => 'View connection points'],
            ['name' => 'Manage Substations', 'group' => 'Substations', 'description' => 'Manage connection points'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['slug' => Str::slug($perm['name'])],
                [
                    'name' => $perm['name'],
                    'slug' => Str::slug($perm['name']),
                    'description' => $perm['description'],
                    'group' => $perm['group'],
                ]
            );
        }

        // ===== ROLES =====
        $admin = Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Full system access']
        );

        $editor = Role::firstOrCreate(
            ['slug' => 'editor'],
            ['name' => 'Editor', 'slug' => 'editor', 'description' => 'Can manage IPPs and view reports']
        );

        $viewer = Role::firstOrCreate(
            ['slug' => 'viewer'],
            ['name' => 'Viewer', 'slug' => 'viewer', 'description' => 'Read-only access']
        );

        // Admin gets all permissions
        $admin->permissions()->sync(Permission::pluck('id'));

        // Editor gets IPP + Reports + Substations view
        $editorPerms = Permission::whereIn('slug', [
            'view-ipp', 'create-ipp', 'edit-ipp',
            'view-reports', 'export-reports',
            'view-substations',
        ])->pluck('id');
        $editor->permissions()->sync($editorPerms);

        // Viewer gets view-only
        $viewerPerms = Permission::whereIn('slug', [
            'view-ipp', 'view-reports', 'view-users', 'view-substations',
        ])->pluck('id');
        $viewer->permissions()->sync($viewerPerms);
    }
}
