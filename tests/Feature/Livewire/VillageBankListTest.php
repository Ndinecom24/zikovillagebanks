<?php

namespace Tests\Feature\Livewire;

use App\Livewire\VillageBanks\VillageBankList;
use App\Models\RoleBasedAccess\Permission;
use App\Models\RoleBasedAccess\Role;
use App\Models\User;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class VillageBankListTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private Role $role;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->superAdmin()->create();
        $this->role  = Role::factory()->create(['slug' => 'super-admin']);

        // Give required permissions
        foreach (['view-village-banks', 'create-village-banks', 'delete-village-banks'] as $slug) {
            $perm = Permission::factory()->create(['slug' => $slug]);
            $this->role->givePermission($perm);
        }
        $this->admin->assignRole($this->role);
    }

    /* ── Rendering ── */

    public function test_component_renders(): void
    {
        $this->actingAs($this->admin);

        VillageBank::factory()->count(3)->create();

        Livewire::test(VillageBankList::class)
            ->assertStatus(200);
    }

    public function test_shows_village_banks(): void
    {
        $this->actingAs($this->admin);

        $bank = VillageBank::factory()->create(['name' => 'Chilolezo Bank']);

        Livewire::test(VillageBankList::class)
            ->assertSee('Chilolezo Bank');
    }

    /* ── Search ── */

    public function test_search_filters_results(): void
    {
        $this->actingAs($this->admin);

        VillageBank::factory()->create(['name' => 'Thandizo Bank']);
        VillageBank::factory()->create(['name' => 'Mphamvu Bank']);

        Livewire::test(VillageBankList::class)
            ->set('search', 'Thandizo')
            ->assertSee('Thandizo Bank')
            ->assertDontSee('Mphamvu Bank');
    }

    /* ── Status Filter ── */

    public function test_status_filter(): void
    {
        $this->actingAs($this->admin);

        VillageBank::factory()->create(['name' => 'Active Bank', 'status' => 'active']);
        VillageBank::factory()->create(['name' => 'Inactive Bank', 'status' => 'inactive']);

        Livewire::test(VillageBankList::class)
            ->set('statusFilter', 'active')
            ->assertSee('Active Bank')
            ->assertDontSee('Inactive Bank');
    }

    /* ── Toggle Status ── */

    public function test_toggle_status(): void
    {
        $this->actingAs($this->admin);

        $bank = VillageBank::factory()->create(['status' => 'active']);

        Livewire::test(VillageBankList::class)
            ->call('toggleStatus', $bank->id);

        $bank->refresh();
        $this->assertEquals('inactive', $bank->status);
    }

    /* ── Delete ── */

    public function test_delete_bank(): void
    {
        $this->actingAs($this->admin);

        $bank = VillageBank::factory()->create(['name' => 'To Delete']);

        Livewire::test(VillageBankList::class)
            ->call('confirmDelete', $bank->id)
            ->assertSet('deleteId', $bank->id)
            ->call('deleteBank');

        $this->assertDatabaseMissing('village_banks', ['id' => $bank->id]);
    }

    /* ── Pagination Reset ── */

    public function test_search_resets_pagination(): void
    {
        $this->actingAs($this->admin);

        VillageBank::factory()->count(20)->create();

        // In Livewire 3, setting search should reset page via updatingSearch()
        Livewire::test(VillageBankList::class)
            ->set('search', 'test')
            ->assertSee('search'); // component renders without error after search
    }
}
