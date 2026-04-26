<?php

namespace App\Livewire\VillageBanking\Loans;

use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Month;
use App\Services\ForcedLoanService;
use App\Traits\HasVillageBankScope;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class ForcedLoan extends Component
{
    use HasVillageBankScope;

    /* ── Selects ── */
    public $circleId  = '';
    public $monthId   = '';

    /* ── Simulation state ── */
    public $simulation     = null;   // result from ForcedLoanService::simulate()
    public $amounts        = [];     // user_id => editable amount
    public $excludeMembers = [];     // user_id => true (admin un-ticks a member)

    /* ── Result state ── */
    public $result         = null;   // result from execute()
    public $showConfirm    = false;

    /* ── Lifecycle ── */

    public function mount()
    {
        $this->autoSelectCurrentCircleAndMonth();
    }

    protected function autoSelectCurrentCircleAndMonth()
    {
        $today = Carbon::today();

        $currentMonth = Month::where('status', 'active')
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        if (!$currentMonth) return;

        $circle = Circle::where('id', $currentMonth->circle_id)
            ->where('status', 'active')
            ->first();

        if (!$circle) return;

        $scopedIds = $this->scopedCircleQuery()
            ->where('status', 'active')
            ->pluck('id');

        if (!$scopedIds->contains($circle->id)) return;

        $this->circleId = (string) $circle->id;
        $this->monthId  = (string) $currentMonth->id;

        $this->runSimulation();
    }

    /* ── Watchers ── */

    public function updatedCircleId()
    {
        $this->monthId    = '';
        $this->simulation = null;
        $this->amounts    = [];
        $this->result     = null;
    }

    public function updatedMonthId()
    {
        $this->simulation = null;
        $this->amounts    = [];
        $this->result     = null;

        if (!empty($this->monthId)) {
            $this->runSimulation();
        }
    }

    /* ── Simulate ── */

    public function runSimulation()
    {
        if (empty($this->monthId)) {
            $this->simulation = null;
            return;
        }

        $this->result     = null;
        $this->showConfirm = false;
        $this->simulation = ForcedLoanService::simulate((int) $this->monthId);

        // Pre-fill editable amounts from computed values
        $this->amounts        = [];
        $this->excludeMembers = [];

        foreach ($this->simulation['allocations'] as $alloc) {
            $memberId = $alloc['member_id'];
            $this->amounts[$memberId] = $alloc['computed_amount'];
            $this->excludeMembers[$memberId] = false;
        }
    }

    /* ── Confirmation step ── */

    public function confirmGenerate()
    {
        if (empty($this->simulation) || $this->simulation['pool_summary']['unborrowed'] <= 0) {
            session()->flash('warning', 'There are no unborrowed funds to distribute.');
            return;
        }

        // Check at least one member is included
        $included = collect($this->amounts)
            ->filter(fn ($amt, $id) => (float) $amt > 0 && empty($this->excludeMembers[$id]));

        if ($included->isEmpty()) {
            session()->flash('warning', 'No eligible members with amounts greater than zero.');
            return;
        }

        // Check total doesn't exceed unborrowed
        $totalAllocated = $included->sum(fn ($amt) => (float) $amt);
        if ($totalAllocated > $this->simulation['pool_summary']['unborrowed'] + 0.01) {
            session()->flash('warning', 'Total allocated (K' . number_format($totalAllocated, 2) . ') exceeds unborrowed funds (K' . number_format($this->simulation['pool_summary']['unborrowed'], 2) . ').');
            return;
        }

        $this->showConfirm = true;
    }

    public function cancelConfirm()
    {
        $this->showConfirm = false;
    }

    /* ── Execute ── */

    public function generateForcedLoans()
    {
        if (empty($this->monthId)) return;

        $month = Month::find($this->monthId);
        if (!$month || $month->status !== 'active') {
            session()->flash('warning', 'Month is not active.');
            return;
        }

        // Build final amounts (exclude un-ticked members)
        $finalAmounts = [];
        foreach ($this->amounts as $memberId => $amount) {
            if (!empty($this->excludeMembers[$memberId])) continue;
            if ((float) $amount <= 0) continue;
            $finalAmounts[$memberId] = (float) $amount;
        }

        if (empty($finalAmounts)) {
            session()->flash('warning', 'No loans to generate.');
            return;
        }

        $this->result = ForcedLoanService::execute(
            (int) $this->monthId,
            $finalAmounts,
            Auth::id()
        );

        $this->showConfirm = false;

        // Re-run simulation to refresh pool numbers
        $this->runSimulation();

        session()->flash('message', $this->result['created_count'] . ' forced loan(s) created totalling K' . number_format($this->result['total_amount'], 2) . '.');
    }

    /* ── Helpers ── */

    public function getTotalAllocatedProperty()
    {
        return collect($this->amounts)
            ->filter(fn ($amt, $id) => (float) $amt > 0 && empty($this->excludeMembers[$id]))
            ->sum(fn ($amt) => (float) $amt);
    }

    public function getIncludedCountProperty()
    {
        return collect($this->amounts)
            ->filter(fn ($amt, $id) => (float) $amt > 0 && empty($this->excludeMembers[$id]))
            ->count();
    }

    /* ── Computed data ── */

    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()
            ->where('status', 'active')
            ->withCount('members')
            ->orderBy('name')
            ->get();
    }

    public function getMonthsProperty()
    {
        if (empty($this->circleId)) return collect();
        return Month::where('circle_id', $this->circleId)
            ->where('status', 'active')
            ->orderBy('month_number')
            ->get();
    }

    public function render()
    {
        return view('livewire.village-banking.loans.forced-loan', [
            'circles'        => $this->circles,
            'months'         => $this->months,
            'totalAllocated' => $this->totalAllocated,
            'includedCount'  => $this->includedCount,
        ]);
    }
}
