<?php

namespace App\Livewire\Subscription;

use App\Models\Subscription\PromoCode;
use App\Models\Subscription\SubscriptionPlan;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.main.master-livewire')]
class PromoCodeManager extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $filterStatus = '';

    /* ── Modal state ── */
    public $showModal = false;
    public $editId = null;

    /* ── Form fields ── */
    public $code = '';
    public $description = '';
    public $type = 'percentage';
    public $value = '';
    public $minPlanPrice = 0;
    public $maxUses = '';
    public $maxUsesPerBank = 1;
    public $planId = '';
    public $startsAt = '';
    public $expiresAt = '';
    public $isActive = true;

    /* ── Delete ── */
    public $confirmDeleteId = null;

    protected function rules()
    {
        $uniqueCode = $this->editId
            ? 'unique:promo_codes,code,' . $this->editId
            : 'unique:promo_codes,code';

        return [
            'code'           => 'required|string|max:40|' . $uniqueCode,
            'description'    => 'nullable|string|max:500',
            'type'           => 'required|in:percentage,fixed',
            'value'          => 'required|numeric|min:0.01',
            'minPlanPrice'   => 'nullable|numeric|min:0',
            'maxUses'        => 'nullable|integer|min:1',
            'maxUsesPerBank' => 'required|integer|min:1',
            'planId'         => 'nullable|exists:subscription_plans,id',
            'startsAt'       => 'nullable|date',
            'expiresAt'      => 'nullable|date|after_or_equal:startsAt',
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function generateCode()
    {
        $this->code = strtoupper(Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4));
    }

    /* ── Modal actions ── */
    public function openCreate()
    {
        $this->resetForm();
        $this->generateCode();
        $this->showModal = true;
    }

    public function openEdit($id)
    {
        $promo = PromoCode::findOrFail($id);
        $this->editId          = $promo->id;
        $this->code            = $promo->code;
        $this->description     = $promo->description ?? '';
        $this->type            = $promo->type;
        $this->value           = $promo->value;
        $this->minPlanPrice    = $promo->min_plan_price;
        $this->maxUses         = $promo->max_uses ?? '';
        $this->maxUsesPerBank  = $promo->max_uses_per_bank;
        $this->planId          = $promo->plan_id ?? '';
        $this->startsAt        = $promo->starts_at ? $promo->starts_at->format('Y-m-d\TH:i') : '';
        $this->expiresAt       = $promo->expires_at ? $promo->expires_at->format('Y-m-d\TH:i') : '';
        $this->isActive        = $promo->is_active;
        $this->showModal       = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'code'              => strtoupper(trim($this->code)),
            'description'       => $this->description ?: null,
            'type'              => $this->type,
            'value'             => $this->value,
            'min_plan_price'    => $this->minPlanPrice ?: 0,
            'max_uses'          => $this->maxUses ?: null,
            'max_uses_per_bank' => $this->maxUsesPerBank,
            'plan_id'           => $this->planId ?: null,
            'starts_at'         => $this->startsAt ?: null,
            'expires_at'        => $this->expiresAt ?: null,
            'is_active'         => $this->isActive,
        ];

        if ($this->editId) {
            PromoCode::findOrFail($this->editId)->update($data);
            session()->flash('success', 'Promo code updated successfully.');
        } else {
            $data['times_used'] = 0;
            PromoCode::create($data);
            session()->flash('success', 'Promo code created successfully.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function toggleActive($id)
    {
        $promo = PromoCode::findOrFail($id);
        $promo->update(['is_active' => ! $promo->is_active]);
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function delete()
    {
        if ($this->confirmDeleteId) {
            $promo = PromoCode::findOrFail($this->confirmDeleteId);
            if ($promo->times_used > 0) {
                session()->flash('error', 'Cannot delete a promo code that has been used. Deactivate it instead.');
            } else {
                $promo->delete();
                session()->flash('success', 'Promo code deleted successfully.');
            }
            $this->confirmDeleteId = null;
        }
    }

    private function resetForm()
    {
        $this->reset([
            'editId', 'code', 'description', 'type', 'value',
            'minPlanPrice', 'maxUses', 'maxUsesPerBank', 'planId',
            'startsAt', 'expiresAt', 'isActive',
        ]);
        $this->isActive = true;
        $this->type = 'percentage';
        $this->maxUsesPerBank = 1;
        $this->resetErrorBag();
    }

    public function render()
    {
        $promos = PromoCode::query()
            ->when($this->search, fn ($q) =>
                $q->where('code', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
            )
            ->when($this->filterStatus === 'active', fn ($q) => $q->where('is_active', true))
            ->when($this->filterStatus === 'inactive', fn ($q) => $q->where('is_active', false))
            ->latest()
            ->paginate($this->perPage);

        $plans = SubscriptionPlan::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('livewire.subscription.promo-code-manager', compact('promos', 'plans'));
    }
}
