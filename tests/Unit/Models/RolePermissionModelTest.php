<?php

namespace Tests\Unit\Models;

use App\Models\RoleBasedAccess\Permission;
use App\Models\RoleBasedAccess\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RolePermissionModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->superAdmin()->create());
    }

    /* ── Role ── */

    public function test_role_has_many_permissions(): void
    {
        $role  = Role::factory()->create();
        $perms = Permission::factory()->count(3)->create();

        foreach ($perms as $perm) {
            $role->givePermission($perm);
        }

        $this->assertCount(3, $role->permissions);
    }

    public function test_role_has_permission(): void
    {
        $role = Role::factory()->create();
        $perm = Permission::factory()->create(['slug' => 'manage-loans']);

        $role->givePermission($perm);

        $this->assertTrue($role->hasPermission('manage-loans'));
        $this->assertFalse($role->hasPermission('delete-everything'));
    }

    public function test_role_give_permission_prevents_duplicates(): void
    {
        $role = Role::factory()->create();
        $perm = Permission::factory()->create();

        $role->givePermission($perm);
        $role->givePermission($perm); // second attach should be idempotent

        $this->assertCount(1, $role->permissions);
    }

    public function test_role_revoke_permission(): void
    {
        $role = Role::factory()->create();
        $perm = Permission::factory()->create(['slug' => 'view-reports']);

        $role->givePermission($perm);
        $this->assertTrue($role->hasPermission('view-reports'));

        $role->revokePermission($perm);
        $role->refresh();
        $this->assertFalse($role->hasPermission('view-reports'));
    }

    public function test_role_has_many_users(): void
    {
        $role  = Role::factory()->create();
        $users = User::factory()->count(3)->create();

        foreach ($users as $user) {
            $user->assignRole($role);
        }

        $this->assertCount(3, $role->users);
    }

    /* ── Permission ── */

    public function test_permission_has_many_roles(): void
    {
        $perm  = Permission::factory()->create();
        $roles = Role::factory()->count(2)->create();

        foreach ($roles as $role) {
            $role->givePermission($perm);
        }

        $this->assertCount(2, $perm->roles);
    }

    public function test_permission_fillable(): void
    {
        $perm = Permission::factory()->create([
            'name'  => 'View Banks',
            'slug'  => 'view-village-banks',
            'group' => 'village-banks',
        ]);

        $this->assertEquals('View Banks', $perm->name);
        $this->assertEquals('view-village-banks', $perm->slug);
        $this->assertEquals('village-banks', $perm->group);
    }
}
