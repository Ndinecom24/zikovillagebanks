<?php

namespace App\Http\Livewire\Subscription;

use App\Models\Subscription\PaymentConfiguration;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentConfigManager extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    /* ── Modal state ── */
    public $showModal = false;
    public $editId = null;

    /* ── Form fields ── */
    public $methodName = '';
    public $provider = '';
    public $accountName = '';
    public $accountNumber = '';
    public $branch = '';
    public $instructions = '';
    public $isActive = true;
    public $sortOrder = 0;

    /* ── Delete ── */
    public $confirmDeleteId = null;

    protected function rules()
    {
        return [
            'methodName'    => 'required|string|max:255',
            'provider'      => 'nullable|string|max:255',
            'accountName'   => 'nullable|string|max:255',
            'accountNumber' => 'nullable|string|max:255',
            'branch'        => 'nullable|string|max:255',
            'instructions'  => 'nullable|string|max:1000',
            'isActive'      => 'boolean',
            'sortOrder'     => 'integer|min:0',
        ];
    }

    protected $messages = [
        'methodName.required' => 'Payment method name is required.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* ── Modal actions ─────────────── */

    public function openCreate()
    {
        $this->resetForm();
        $this->editId = null;
        $this->showModal = true;
    }

    public function openEdit($id)
    {
        $config = PaymentConfiguration::findOrFail($id);
        $this->editId       = $config->id;
        $this->methodName   = $config->method_name;
        $this->provider     = $config->provider ?? '';
        $this->accountName  = $config->account_name ?? '';
        $this->accountNumber = $config->account_number ?? '';
        $this->branch       = $config->branch ?? '';
        $this->instructions = $config->instructions ?? '';
        $this->isActive     = $config->is_active;
        $this->sortOrder    = $config->sort_order;
        $this->showModal    = true;
    }

    public function save()
    {
        $this->validate();

        PaymentConfiguration::updateOrCreate(
            ['id' => $this->editId],
            [
                'method_name'    => $this->methodName,
                'provider'       => $this->provider ?: null,
                'account_name'   => $this->accountName ?: null,
                'account_number' => $this->accountNumber ?: null,
                'branch'         => $this->branch ?: null,
                'instructions'   => $this->instructions ?: null,
                'is_active'      => $this->isActive,
                'sort_order'     => $this->sortOrder,
            ]
        );

        $this->showModal = false;
        $this->resetForm();

        session()->flash('success', $this->editId ? 'Payment method updated.' : 'Payment method created.');
    }

    public function toggleActive($id)
    {
        $config = PaymentConfiguration::findOrFail($id);
        $config->update(['is_active' => !$config->is_active]);
        session()->flash('success', $config->method_name . ($config->is_active ? ' activated.' : ' deactivated.'));
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function delete()
    {
        if ($this->confirmDeleteId) {
            PaymentConfiguration::destroy($this->confirmDeleteId);
            $this->confirmDeleteId = null;
            session()->flash('success', 'Payment method deleted.');
        }
    }

    public function cancelDelete()
    {
        $this->confirmDeleteId = null;
    }

    private function resetForm()
    {
        $this->reset([
            'methodName', 'provider', 'accountName', 'accountNumber',
            'branch', 'instructions', 'isActive', 'sortOrder', 'editId',
        ]);
        $this->isActive = true;
        $this->sortOrder = 0;
        $this->resetErrorBag();
    }

    public function render()
    {
        $configs = PaymentConfiguration::query()
            ->when($this->search, function ($q) {
                $q->where('method_name', 'like', '%' . $this->search . '%')
                  ->orWhere('provider', 'like', '%' . $this->search . '%')
                  ->orWhere('account_name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('sort_order')
            ->orderBy('method_name')
            ->paginate($this->perPage);

        return view('livewire.subscription.payment-config-manager', compact('configs'));
    }
}
