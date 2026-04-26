<?php

namespace Tests\Feature\Livewire;

use App\Livewire\VillageBanks\VillageBankShow;
use App\Models\RoleBasedAccess\Permission;
use App\Models\RoleBasedAccess\Role;
use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class VillageBankShowTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private VillageBank $bank;
    private Role $role;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->superAdmin()->create();
        $this->bank  = VillageBank::factory()->create(['created_by' => $this->admin->id]);

        // Give admin the 'view-village-banks' permission
        $this->role = Role::factory()->create(['slug' => 'super-admin']);
        $perm = Permission::factory()->create(['slug' => 'view-village-banks']);
        $this->role->givePermission($perm);
        $this->admin->assignRole($this->role);

        $this->bank->members()->attach($this->admin->id, ['role' => 'admin', 'joined_at' => now()]);
    }

    /* ── Rendering ── */

    public function test_component_renders(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->assertStatus(200)
            ->assertSee($this->bank->name);
    }

    public function test_overview_tab_shows_stats(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->assertSet('activeTab', 'overview')
            ->assertSee('Total Circles')
            ->assertSee('Total Members')
            ->assertSee('Contributions');
    }

    /* ── Tab Switching ── */

    public function test_switch_to_members_tab(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->set('activeTab', 'members')
            ->assertSee('Members');
    }

    public function test_switch_to_circles_tab(): void
    {
        $this->actingAs($this->admin);
        Circle::factory()->create([
            'village_bank_id' => $this->bank->id,
            'name'            => 'Alpha Circle',
        ]);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->set('activeTab', 'circles')
            ->assertSee('Alpha Circle');
    }

    public function test_switch_to_finance_tab(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->set('activeTab', 'finance')
            ->assertSee('Financial Summary')
            ->assertSee('Key Metrics');
    }

    public function test_switch_to_settings_tab(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->set('activeTab', 'settings')
            ->assertSee('Shares')
            ->assertSee('Loan Settings');
    }

    /* ── Member Management ── */

    public function test_add_member(): void
    {
        $this->actingAs($this->admin);
        $newUser = User::factory()->create();

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->call('openAddMember')
            ->assertSet('showAddMember', true)
            ->set('selectedUserId', $newUser->id)
            ->set('memberRole', 'member')
            ->call('addMember')
            ->assertSet('showAddMember', false);

        $this->assertDatabaseHas('village_bank_members', [
            'village_bank_id' => $this->bank->id,
            'user_id'         => $newUser->id,
            'role'            => 'member',
        ]);
    }

    public function test_add_member_prevents_duplicate(): void
    {
        $this->actingAs($this->admin);
        $existing = User::factory()->create();
        $this->bank->members()->attach($existing->id, ['role' => 'member', 'joined_at' => now()]);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->call('openAddMember')
            ->set('selectedUserId', $existing->id)
            ->set('memberRole', 'member')
            ->call('addMember')
            ->assertHasErrors('selectedUserId');
    }

    public function test_add_member_validation(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->call('openAddMember')
            ->set('selectedUserId', '')
            ->call('addMember')
            ->assertHasErrors(['selectedUserId' => 'required']);
    }

    public function test_remove_member(): void
    {
        $this->actingAs($this->admin);
        $member = User::factory()->create();
        $this->bank->members()->attach($member->id, ['role' => 'member', 'joined_at' => now()]);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->call('confirmRemoveMember', $member->id)
            ->assertSet('removeMemberId', $member->id)
            ->call('removeMember');

        $this->assertDatabaseMissing('village_bank_members', [
            'village_bank_id' => $this->bank->id,
            'user_id'         => $member->id,
        ]);
    }

    public function test_change_member_role(): void
    {
        $this->actingAs($this->admin);
        $member = User::factory()->create();
        $this->bank->members()->attach($member->id, ['role' => 'member', 'joined_at' => now()]);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->call('changeRole', $member->id, 'admin');

        $this->assertDatabaseHas('village_bank_members', [
            'village_bank_id' => $this->bank->id,
            'user_id'         => $member->id,
            'role'            => 'admin',
        ]);
    }

    /* ── Member Search ── */

    public function test_search_users_computed_property(): void
    {
        $this->actingAs($this->admin);
        $searchable = User::factory()->create(['name' => 'John Banda']);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->call('openAddMember')
            ->set('memberSearch', 'John')
            ->assertSee('John Banda');
    }

    public function test_search_excludes_existing_members(): void
    {
        $this->actingAs($this->admin);
        $existing = User::factory()->create(['name' => 'Existing Member']);
        $this->bank->members()->attach($existing->id, ['role' => 'member', 'joined_at' => now()]);

        Livewire::test(VillageBankShow::class, ['bankId' => $this->bank->id])
            ->call('openAddMember')
            ->set('memberSearch', 'Existing')
            ->assertDontSee('Existing Member');
    }
}
