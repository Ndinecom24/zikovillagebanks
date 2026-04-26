<?php

namespace Tests\Unit\Models;

use App\Models\RoleBasedAccess\Permission;
use App\Models\RoleBasedAccess\Role;
use App\Models\User;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->superAdmin()->create());
    }

    /* ── Super Admin Detection ── */

    public function test_is_super_admin(): void
    {
        $superAdmin = User::factory()->superAdmin()->create();
        $regular    = User::factory()->create(['user_role_id' => 2]);

        $this->assertTrue($superAdmin->isSuperAdmin());
        $this->assertFalse($regular->isSuperAdmin());
    }

    /* ── Village Bank Relationship ── */

    public function test_user_village_banks(): void
    {
        $user  = User::factory()->create();
        $banks = VillageBank::factory()->count(2)->create();

        foreach ($banks as $bank) {
            $bank->members()->attach($user->id, ['role' => 'member', 'joined_at' => now()]);
        }

        $this->assertCount(2, $user->villageBanks);
    }

    public function test_user_admin_village_banks(): void
    {
        $user = User::factory()->create();
        $bank1 = VillageBank::factory()->create();
        $bank2 = VillageBank::factory()->create();

        $bank1->members()->attach($user->id, ['role' => 'admin', 'joined_at' => now()]);
        $bank2->members()->attach($user->id, ['role' => 'member', 'joined_at' => now()]);

        $this->assertCount(1, $user->adminVillageBanks);
    }

    public function test_user_village_bank_ids(): void
    {
        $user  = User::factory()->create();
        $bank  = VillageBank::factory()->create();
        $bank->members()->attach($user->id, ['role' => 'member', 'joined_at' => now()]);

        $ids = $user->villageBankIds();
        $this->assertContains($bank->id, $ids);
    }

    /* ── Roles & Permissions ── */

    public function test_user_can_be_assigned_role(): void
    {
        $user = User::factory()->create();
        $role = Role::factory()->create(['slug' => 'bank-admin']);

        $user->assignRole($role);

        $this->assertTrue($user->hasRole('bank-admin'));
    }

    public function test_user_has_permission_through_role(): void
    {
        $user = User::factory()->create();
        $role = Role::factory()->create(['slug' => 'admin']);
        $perm = Permission::factory()->create(['slug' => 'view-village-banks']);

        $role->givePermission($perm);
        $user->assignRole($role);

        $this->assertTrue($user->hasPermission('view-village-banks'));
    }

    public function test_user_has_any_role(): void
    {
        $user  = User::factory()->create();
        $role1 = Role::factory()->create(['slug' => 'admin']);
        $role2 = Role::factory()->create(['slug' => 'editor']);

        $user->assignRole($role1);

        $this->assertTrue($user->hasAnyRole(['admin', 'editor']));
        $this->assertFalse($user->hasAnyRole(['editor', 'viewer']));
    }

    /* ── Loans Relationship ── */

    public function test_user_has_many_loans(): void
    {
        $user = User::factory()->create();
        \App\Models\VillageBanking\Loan::factory()->count(3)->create([
            'borrower_id' => $user->id,
        ]);

        $this->assertCount(3, $user->loans);
    }

    /* ── Share Declarations ── */

    public function test_user_has_many_share_declarations(): void
    {
        $user = User::factory()->create();
        \App\Models\VillageBanking\ShareDeclaration::factory()->count(2)->create([
            'user_id' => $user->id,
        ]);

        $this->assertCount(2, $user->shareDeclarations);
    }
}
