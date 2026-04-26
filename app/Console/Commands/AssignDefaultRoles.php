<?php

namespace App\Console\Commands;

use App\Models\RoleBasedAccess\Role;
use App\Models\User;
use Illuminate\Console\Command;

class AssignDefaultRoles extends Command
{
    protected $signature = 'users:assign-default-roles
                            {--role=member : The role slug to assign (default: member)}
                            {--dry-run : Show what would be done without making changes}';

    protected $description = 'Assign default role to all users who have no roles in role_user pivot (excluding super-admins)';

    public function handle()
    {
        $roleSlug = $this->option('role');
        $dryRun   = $this->option('dry-run');

        $role = Role::where('slug', $roleSlug)->first();

        if (!$role) {
            $this->error("Role '{$roleSlug}' not found. Run the RolesAndPermissionsSeeder first.");
            return 1;
        }

        // Find users with no roles assigned (excluding super-admins with user_role_id = 1)
        $usersWithoutRoles = User::whereDoesntHave('roles')
            ->where(function ($q) {
                $q->whereNull('user_role_id')
                  ->orWhere('user_role_id', '!=', '1');
            })
            ->get();

        if ($usersWithoutRoles->isEmpty()) {
            $this->info('All non-super-admin users already have roles assigned. Nothing to do.');
            return 0;
        }

        $this->info("Found {$usersWithoutRoles->count()} user(s) without roles.");

        if ($dryRun) {
            $this->warn('[DRY RUN] No changes will be made.');
            $this->table(
                ['ID', 'Name', 'Email', 'user_role_id', 'Status'],
                $usersWithoutRoles->map(fn ($u) => [
                    $u->id, $u->name, $u->email, $u->user_role_id ?? 'NULL', $u->status ?? 'N/A',
                ])
            );
            return 0;
        }

        $bar = $this->output->createProgressBar($usersWithoutRoles->count());
        $assigned = 0;

        foreach ($usersWithoutRoles as $user) {
            $user->assignRole($role);
            $assigned++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Successfully assigned '{$roleSlug}' role to {$assigned} user(s).");

        return 0;
    }
}
