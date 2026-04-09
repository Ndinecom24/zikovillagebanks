<?php

namespace App\Http\Livewire\VillageBanking\Rules;

use App\Models\VillageBanking\Rule;
use App\Models\VillageBanking\RuleAcknowledgement;
use App\Models\VillageBanking\VillageBank;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RuleManager extends Component
{
    use WithPagination, HasVillageBankScope;

    protected $paginationTheme = 'bootstrap';

    /* ── Filters ─────────────────────── */
    public $search = '';
    public $categoryFilter = '';
    public $perPage = 15;

    /* ── Create / Edit ───────────────── */
    public $showFormModal = false;
    public $editingId = null;
    public $title = '';
    public $description = '';
    public $category = 'general';
    public $sortOrder = 0;
    public $isActive = true;
    public $formBankId = '';

    /* ── Delete ───────────────────────── */
    public $deleteId;
    public $deleteTitle;

    protected $queryString = [
        'search'         => ['except' => ''],
        'categoryFilter' => ['except' => '', 'as' => 'category'],
        'villageBankId'  => ['except' => '', 'as' => 'bank'],
    ];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingCategoryFilter() { $this->resetPage(); }

    /* ── Form: Open Create ───────────── */

    public function openCreate()
    {
        $this->resetForm();
        $this->formBankId = $this->villageBankId;
        $this->showFormModal = true;
    }

    /* ── Form: Open Edit ─────────────── */

    public function openEdit($id)
    {
        $rule = Rule::findOrFail($id);
        $this->editingId   = $rule->id;
        $this->formBankId  = $rule->village_bank_id;
        $this->title       = $rule->title;
        $this->description = $rule->description;
        $this->category    = $rule->category;
        $this->sortOrder   = $rule->sort_order;
        $this->isActive    = $rule->is_active;
        $this->showFormModal = true;
    }

    /* ── Form: Save ──────────────────── */

    public function saveRule()
    {
        $this->validate([
            'formBankId'  => 'required|exists:village_banks,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category'    => 'required|string',
            'sortOrder'   => 'required|integer|min:0',
        ], [
            'formBankId.required'  => 'Select a village bank.',
            'title.required'       => 'Rule title is required.',
            'description.required' => 'Rule description is required.',
            'description.min'      => 'Description must be at least 10 characters.',
        ]);

        $data = [
            'village_bank_id' => $this->formBankId,
            'title'           => $this->title,
            'description'     => $this->description,
            'category'        => $this->category,
            'sort_order'      => $this->sortOrder,
            'is_active'       => $this->isActive,
        ];

        if ($this->editingId) {
            Rule::findOrFail($this->editingId)->update($data);
            session()->flash('message', 'Rule updated successfully.');
        } else {
            $data['created_by'] = Auth::id();
            Rule::create($data);
            session()->flash('message', 'Rule created successfully.');
        }

        $this->showFormModal = false;
        $this->resetForm();
    }

    /* ── Toggle Active ───────────────── */

    public function toggleActive($id)
    {
        $rule = Rule::findOrFail($id);
        $rule->update(['is_active' => !$rule->is_active]);
        session()->flash('message', $rule->title . ' ' . ($rule->is_active ? 'activated' : 'deactivated') . '.');
    }

    /* ── Acknowledge ─────────────────── */

    public function acknowledge($ruleId)
    {
        RuleAcknowledgement::firstOrCreate(
            ['rule_id' => $ruleId, 'user_id' => Auth::id()],
            ['acknowledged_at' => now()]
        );
        session()->flash('message', 'Rule acknowledged.');
    }

    /* ── Delete ───────────────────────── */

    public function confirmDelete($id)
    {
        $rule = Rule::find($id);
        if ($rule) {
            $this->deleteId = $id;
            $this->deleteTitle = $rule->title;
        }
    }

    public function deleteRule()
    {
        $rule = Rule::find($this->deleteId);
        if ($rule) {
            $rule->delete();
        }
        session()->flash('message', 'Rule deleted.');
        $this->reset(['deleteId', 'deleteTitle']);
    }

    /* ── Helpers ──────────────────────── */

    private function resetForm()
    {
        $this->reset(['editingId', 'title', 'description', 'sortOrder', 'formBankId']);
        $this->category = 'general';
        $this->isActive = true;
        $this->resetErrorBag();
    }

    /* ── Render ───────────────────────── */

    public function render()
    {
        $query = Rule::with(['creator', 'villageBank'])
            ->withCount('acknowledgements');

        // Scope by village bank
        if (!empty($this->villageBankId)) {
            $query->where('village_bank_id', $this->villageBankId);
        }

        if (!empty($this->categoryFilter)) {
            $query->where('category', $this->categoryFilter);
        }

        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', $term)
                  ->orWhere('description', 'like', $term);
            });
        }

        $rules = $query->orderBy('sort_order')->orderBy('title')->paginate($this->perPage);

        // Stats
        $baseQuery = Rule::query();
        if (!empty($this->villageBankId)) {
            $baseQuery->where('village_bank_id', $this->villageBankId);
        }
        $totalRules  = (clone $baseQuery)->count();
        $activeRules = (clone $baseQuery)->where('is_active', true)->count();

        $categories = Rule::CATEGORIES;

        return view('livewire.village-banking.rules.rule-manager', compact(
            'rules', 'totalRules', 'activeRules', 'categories',
        ))->layout('layouts.main.master-livewire');
    }
}
