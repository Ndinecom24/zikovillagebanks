<?php

namespace Tests\Feature\Livewire;

use App\Livewire\VillageBanks\VillageBankCreate;
use App\Models\RoleBasedAccess\Permission;
use App\Models\RoleBasedAccess\Role;
use App\Models\User;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class VillageBankCreateTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->superAdmin()->create();

        $role = Role::factory()->create(['slug' => 'super-admin']);
        $perm = Permission::factory()->create(['slug' => 'create-village-banks']);
        $role->givePermission($perm);
        $this->admin->assignRole($role);
    }

    public function test_component_renders(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(VillageBankCreate::class)
            ->assertStatus(200);
    }

    public function test_create_village_bank(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(VillageBankCreate::class)
            ->set('name', 'New Village Bank')
            ->set('code', 'NVB-001')
            ->set('email', 'nvb@test.com')
            ->set('phone', '0999123456')
            ->call('save');

        $this->assertDatabaseHas('village_banks', [
            'name' => 'New Village Bank',
            'code' => 'NVB-001',
        ]);
    }

    public function test_creator_is_attached_as_admin_member(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(VillageBankCreate::class)
            ->set('name', 'My Bank')
            ->set('code', 'MB-001')
            ->call('save');

        $bank = VillageBank::where('code', 'MB-001')->first();
        $this->assertNotNull($bank);

        $this->assertDatabaseHas('village_bank_members', [
            'village_bank_id' => $bank->id,
            'user_id'         => $this->admin->id,
            'role'            => 'admin',
        ]);
    }

    public function test_validation_required_fields(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(VillageBankCreate::class)
            ->set('name', '')
            ->set('code', '')
            ->call('save')
            ->assertHasErrors(['name' => 'required', 'code' => 'required']);
    }

    public function test_validation_unique_name_and_code(): void
    {
        $this->actingAs($this->admin);

        VillageBank::factory()->create(['name' => 'Existing Bank', 'code' => 'EB-001']);

        Livewire::test(VillageBankCreate::class)
            ->set('name', 'Existing Bank')
            ->set('code', 'EB-001')
            ->call('save')
            ->assertHasErrors(['name' => 'unique', 'code' => 'unique']);
    }

    public function test_edit_mode_loads_existing_bank(): void
    {
        $this->actingAs($this->admin);

        $bank = VillageBank::factory()->create([
            'name'  => 'Edit Me',
            'code'  => 'EM-001',
            'email' => 'edit@test.com',
        ]);

        Livewire::withQueryParams(['edit' => $bank->id])
            ->test(VillageBankCreate::class)
            ->assertSet('name', 'Edit Me')
            ->assertSet('code', 'EM-001')
            ->assertSet('email', 'edit@test.com');
    }

    public function test_edit_mode_updates_bank(): void
    {
        $this->actingAs($this->admin);

        $bank = VillageBank::factory()->create([
            'name' => 'Old Name',
            'code' => 'ON-001',
        ]);

        Livewire::withQueryParams(['edit' => $bank->id])
            ->test(VillageBankCreate::class)
            ->set('name', 'Updated Name')
            ->call('save');

        $this->assertDatabaseHas('village_banks', [
            'id'   => $bank->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_reset_form(): void
    {
        $this->actingAs($this->admin);

        Livewire::test(VillageBankCreate::class)
            ->set('name', 'Some Bank')
            ->set('code', 'SB-001')
            ->call('resetForm')
            ->assertSet('name', '')
            ->assertSet('code', '');
    }
}
