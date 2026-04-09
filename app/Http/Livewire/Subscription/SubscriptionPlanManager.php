<?php

namespace App\Http\Livewire\Subscription;

use App\Models\Subscription\SubscriptionPlan;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SubscriptionPlanManager extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    /* ── Modal state ── */
    public $showModal = false;
    public $editId = null;

    /* ── Form fields ── */
    public $name = '';
    public $slug = '';
    public $description = '';
    public $price = '';
    public $billingCycle = 'monthly';
    public $durationDays = 30;
    public $maxCircles = '';
    public $maxMembers = '';
    public $featuresText = '';
    public $isActive = true;
    public $isFeatured = false;
    public $sortOrder = 0;

    /* ── Delete ── */
    public $confirmDeleteId = null;

    protected function rules()
    {
        $uniqueSlug = $this->editId
            ? 'unique:subscription_plans,slug,' . $this->editId
            : 'unique:subscription_plans,slug';

        return [
            'name'         => 'required|string|max:255',
            'slug'         => 'required|string|max:255|' . $uniqueSlug,
            'price'        => 'required|numeric|min:0',
            'billingCycle' => 'required|in:monthly,quarterly,yearly',
            'durationDays' => 'required|integer|min:1',
            'maxCircles'   => 'nullable|integer|min:1',
            'maxMembers'   => 'nullable|integer|min:1',
            'sortOrder'    => 'integer|min:0',
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedName($value)
    {
        if (!$this->editId) {
            $this->slug = Str::slug($value);
        }
    }

    /* ── Modal actions ── */
    public function openCreate()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEdit($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        $this->editId       = $plan->id;
        $this->name         = $plan->name;
        $this->slug         = $plan->slug;
        $this->description  = $plan->description ?? '';
        $this->price        = $plan->price;
        $this->billingCycle = $plan->billing_cycle;
        $this->durationDays = $plan->duration_days;
        $this->maxCircles   = $plan->max_circles ?? '';
        $this->maxMembers   = $plan->max_members ?? '';
        $this->featuresText = is_array($plan->features) ? implode("\n", $plan->features) : '';
        $this->isActive     = $plan->is_active;
        $this->isFeatured   = $plan->is_featured;
        $this->sortOrder    = $plan->sort_order;
        $this->showModal    = true;
    }

    public function save()
    {
        $this->validate();

        $features = array_values(array_filter(array_map('trim', explode("\n", $this->featuresText))));

        $data = [
            'name'          => $this->name,
            'slug'          => $this->slug,
            'description'   => $this->description ?: null,
            'price'         => $this->price,
            'billing_cycle' => $this->billingCycle,
            'duration_days' => $this->durationDays,
            'max_circles'   => $this->maxCircles ?: null,
            'max_members'   => $this->maxMembers ?: null,
            'features'      => $features,
            'is_active'     => $this->isActive,
            'is_featured'   => $this->isFeatured,
            'sort_order'    => $this->sortOrder,
        ];

        if ($this->editId) {
            SubscriptionPlan::findOrFail($this->editId)->update($data);
            session()->flash('success', 'Plan updated successfully.');
        } else {
            SubscriptionPlan::create($data);
            session()->flash('success', 'Plan created successfully.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function toggleActive($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        $plan->update(['is_active' => !$plan->is_active]);
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function delete()
    {
        if ($this->confirmDeleteId) {
            $plan = SubscriptionPlan::findOrFail($this->confirmDeleteId);
            if ($plan->subscriptions()->exists() || $plan->bankApplications()->exists()) {
                session()->flash('error', 'Cannot delete a plan that has active subscriptions or applications.');
            } else {
                $plan->delete();
                session()->flash('success', 'Plan deleted successfully.');
            }
            $this->confirmDeleteId = null;
        }
    }

    private function resetForm()
    {
        $this->reset([
            'editId', 'name', 'slug', 'description', 'price',
            'billingCycle', 'durationDays', 'maxCircles', 'maxMembers',
            'featuresText', 'isActive', 'isFeatured', 'sortOrder',
        ]);
        $this->isActive = true;
        $this->billingCycle = 'monthly';
        $this->durationDays = 30;
        $this->resetErrorBag();
    }

    public function render()
    {
        $plans = SubscriptionPlan::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->orderBy('sort_order')
            ->orderBy('price')
            ->paginate($this->perPage);

        return view('livewire.subscription.subscription-plan-manager', compact('plans'));
    }
}
