<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Seeds all client-module permissions defined in config/chilolezo.php
 *
 * Usage:
 *   php artisan db:seed --class=ClientPermissionsSeeder
 */
class ClientPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $sections = config('chilolezo.permissions', []);

        $created = 0;
        $skipped = 0;

        foreach ($sections as $sectionKey => $section) {
            $group   = $section['group']   ?? ucfirst($sectionKey);
            $actions = $section['actions'] ?? [];

            foreach ($actions as $slug => $meta) {
                $name        = $meta['name']        ?? $slug;
                $description = $meta['description'] ?? '';
                $permSlug    = Str::slug($slug, '-');   // e.g. "clients.view" → "clients-view"

                $perm = Permission::firstOrCreate(
                    ['slug' => $permSlug],
                    [
                        'name'        => $name,
                        'slug'        => $permSlug,
                        'description' => $description,
                        'group'       => $group,
                    ]
                );

                if ($perm->wasRecentlyCreated) {
                    $created++;
                } else {
                    // Update description/group if the permission already existed
                    $perm->update([
                        'name'        => $name,
                        'description' => $description,
                        'group'       => $group,
                    ]);
                    $skipped++;
                }
            }
        }

        $this->command->info("Client permissions seeded: {$created} created, {$skipped} already existed (updated).");
    }
}
