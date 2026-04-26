<?php

namespace App\Livewire\VillageBanks;

use App\Models\User;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('layouts.main.master-livewire')]
class VillageBankCreate extends Component
{
    use WithFileUploads;

    /* ── Form fields ─────── */
    public $name        = '';
    public $code        = '';
    public $description = '';
    public $address     = '';
    public $phone       = '';
    public $email       = '';
    public $logo;

    /* ── Edit mode ───────── */
    public $editId = null;

    /* ── Member assignment ── */
    public $memberSearch  = '';
    public $selectedAdmin = '';

    /* ── Feedback ──────────── */
    public $successMessage = '';

    protected function rules()
    {
        $uniqueCode = 'unique:village_banks,code';
        $uniqueName = 'unique:village_banks,name';
        if ($this->editId) {
            $uniqueCode .= ',' . $this->editId;
            $uniqueName .= ',' . $this->editId;
        }

        return [
            'name'        => 'required|string|max:255|' . $uniqueName,
            'code'        => 'required|string|max:20|alpha_dash|' . $uniqueCode,
            'description' => 'nullable|string|max:1000',
            'address'     => 'nullable|string|max:255',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'logo'        => $this->editId ? 'nullable|image|max:2048' : 'nullable|image|max:2048',
        ];
    }

    public function mount()
    {
        // If query string has edit param
        if (request()->has('edit')) {
            $bank = VillageBank::find(request('edit'));
            if ($bank) {
                $this->editId      = $bank->id;
                $this->name        = $bank->name;
                $this->code        = $bank->code;
                $this->description = $bank->description ?? '';
                $this->address     = $bank->address ?? '';
                $this->phone       = $bank->phone ?? '';
                $this->email       = $bank->email ?? '';
            }
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name'        => $this->name,
            'code'        => strtoupper($this->code),
            'description' => $this->description,
            'address'     => $this->address,
            'phone'       => $this->phone,
            'email'       => $this->email,
        ];

        if ($this->logo) {
            $data['logo'] = $this->logo->store('village_bank_logos', 'public');
        }

        if ($this->editId) {
            $bank = VillageBank::findOrFail($this->editId);
            $bank->update($data);
            $this->successMessage = 'Village Bank "' . $bank->name . '" updated successfully.';
        } else {
            $data['created_by'] = Auth::id();
            $bank = VillageBank::create($data);

            // Make creator an admin of the bank
            $bank->members()->attach(Auth::id(), [
                'role'      => 'admin',
                'joined_at' => now(),
            ]);

            $this->successMessage = 'Village Bank "' . $bank->name . '" created successfully.';
            $this->resetForm();
        }
    }

    public function resetForm()
    {
        $this->reset(['name', 'code', 'description', 'address', 'phone', 'email', 'logo', 'editId']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.village-banks.village-bank-create');
    }
}
