<?php

namespace App\Http\Livewire\VillageBanking\Shareout;

use Livewire\Component;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\SocialFund;
use App\Models\VillageBanking\SocialFundUsage;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\Auth;

class SocialFundManager extends Component
{
    use HasVillageBankScope;

    /* ── Selection ────────── */
    public $socialFundId = '';

    /* ── Active fund data ── */
    public $fund = null;
    public $usages = [];
    public $circleName = '';
    public $bankName = '';

    /* ── Add-usage form ──── */
    public $showAddForm = false;
    public $usageType = 'payment';
    public $usageDescription = '';
    public $usageAmount = '';
    public $usageRecipient = '';
    public $usageDate = '';
    public $usageNotes = '';

    /* ── Edit mode ───────── */
    public $editingUsageId = null;

    /* ── Delete confirm ──── */
    public $confirmingDeleteId = null;

    /* ── Feedback ─────────── */
    public $successMessage = '';

    protected $rules = [
        'usageType'        => 'required|in:shareout,donation,payment,other',
        'usageDescription' => 'required|string|max:255',
        'usageAmount'      => 'required|numeric|min:0.01',
        'usageRecipient'   => 'nullable|string|max:255',
        'usageDate'        => 'required|date',
        'usageNotes'       => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'usageAmount.max' => 'Amount exceeds remaining fund balance.',
    ];

    /* ── Computed: all social funds scoped to current bank ── */
    public function getSocialFundsProperty()
    {
        $circleIds = $this->scopedCircleIds();

        return SocialFund::with(['circle.villageBank'])
            ->whereIn('circle_id', $circleIds)
            ->orderByDesc('created_at')
            ->get();
    }

    /* ── Lifecycle ────────── */

    public function mount()
    {
        $this->usageDate = now()->format('Y-m-d');
    }

    public function updatedSocialFundId()
    {
        $this->resetForm();
        $this->successMessage = '';
        $this->loadFund();
    }

    /* ── Load fund + usages ── */

    protected function loadFund()
    {
        if (!$this->socialFundId) {
            $this->fund = null;
            $this->usages = [];
            return;
        }

        $this->fund = SocialFund::with(['circle.villageBank', 'usages.recorder'])
            ->find($this->socialFundId);

        if ($this->fund) {
            $this->circleName = $this->fund->circle->name ?? '';
            $this->bankName = $this->fund->circle->villageBank->name ?? '';
            $this->usages = $this->fund->usages->sortByDesc('usage_date')->values()->toArray();
        }
    }

    /* ── Show / hide add form ── */

    public function openAddForm()
    {
        $this->resetForm();
        $this->showAddForm = true;
    }

    public function cancelForm()
    {
        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->showAddForm = false;
        $this->editingUsageId = null;
        $this->confirmingDeleteId = null;
        $this->usageType = 'payment';
        $this->usageDescription = '';
        $this->usageAmount = '';
        $this->usageRecipient = '';
        $this->usageDate = now()->format('Y-m-d');
        $this->usageNotes = '';
        $this->resetValidation();
    }

    /* ── Save usage (create or update) ── */

    public function saveUsage()
    {
        // Dynamic max validation based on remaining balance
        $maxAmount = $this->fund->total_remaining;
        if ($this->editingUsageId) {
            // Allow up to remaining + current usage amount (since we're replacing it)
            $currentUsage = SocialFundUsage::find($this->editingUsageId);
            if ($currentUsage) {
                $maxAmount += $currentUsage->amount;
            }
        }

        $this->rules['usageAmount'] = "required|numeric|min:0.01|max:{$maxAmount}";
        $this->validate();

        if ($this->editingUsageId) {
            $usage = SocialFundUsage::find($this->editingUsageId);
            if ($usage) {
                $usage->update([
                    'type'        => $this->usageType,
                    'description' => $this->usageDescription,
                    'amount'      => $this->usageAmount,
                    'recipient'   => $this->usageRecipient ?: null,
                    'usage_date'  => $this->usageDate,
                    'notes'       => $this->usageNotes ?: null,
                ]);
                $this->successMessage = 'Usage record updated successfully.';
            }
        } else {
            SocialFundUsage::create([
                'social_fund_id' => $this->fund->id,
                'type'           => $this->usageType,
                'description'    => $this->usageDescription,
                'amount'         => $this->usageAmount,
                'recipient'      => $this->usageRecipient ?: null,
                'usage_date'     => $this->usageDate,
                'recorded_by'    => Auth::id(),
                'notes'          => $this->usageNotes ?: null,
            ]);
            $this->successMessage = 'Usage of K' . number_format($this->usageAmount, 2) . ' recorded successfully.';
        }

        // Recalculate fund totals
        $this->fund->recalculate();
        $this->resetForm();
        $this->loadFund();
    }

    /* ── Edit an existing usage ── */

    public function editUsage($usageId)
    {
        $usage = SocialFundUsage::find($usageId);
        if (!$usage || $usage->social_fund_id != $this->fund->id) return;

        $this->editingUsageId = $usageId;
        $this->usageType = $usage->type;
        $this->usageDescription = $usage->description;
        $this->usageAmount = $usage->amount;
        $this->usageRecipient = $usage->recipient ?? '';
        $this->usageDate = $usage->usage_date->format('Y-m-d');
        $this->usageNotes = $usage->notes ?? '';
        $this->showAddForm = true;
    }

    /* ── Delete usage ── */

    public function confirmDelete($usageId)
    {
        $this->confirmingDeleteId = $usageId;
    }

    public function cancelDelete()
    {
        $this->confirmingDeleteId = null;
    }

    public function deleteUsage($usageId)
    {
        $usage = SocialFundUsage::find($usageId);
        if (!$usage || $usage->social_fund_id != $this->fund->id) return;

        $deletedAmount = $usage->amount;
        $usage->delete();

        // Recalculate fund totals
        $this->fund->recalculate();
        $this->confirmingDeleteId = null;
        $this->successMessage = 'Usage of K' . number_format($deletedAmount, 2) . ' deleted. Fund balance restored.';
        $this->loadFund();
    }

    /* ── Close fund manually ── */

    public function closeFund()
    {
        if (!$this->fund) return;

        $this->fund->update(['status' => 'closed']);
        $this->successMessage = 'Social fund has been closed.';
        $this->loadFund();
    }

    /* ── Reopen fund ── */

    public function reopenFund()
    {
        if (!$this->fund) return;

        $status = $this->fund->total_remaining <= 0 ? 'depleted' : 'active';
        $this->fund->update(['status' => $status]);
        $this->successMessage = 'Social fund has been reopened.';
        $this->loadFund();
    }

    public function render()
    {
        return view('livewire.village-banking.shareout.social-fund-manager')
            ->layout('layouts.main.master-livewire');
    }
}
