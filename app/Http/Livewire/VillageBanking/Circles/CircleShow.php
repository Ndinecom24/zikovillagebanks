<?php

namespace App\Http\Livewire\VillageBanking\Circles;

use App\Models\VillageBanking\Circle;
use Livewire\Component;

class CircleShow extends Component
{
    public $circleId;
    public $circle;

    // Stats
    public $totalMembers = 0;
    public $totalMonths = 0;
    public $totalLoans = 0;
    public $totalLoanAmount = 0;
    public $activeLoans = 0;
    public $completedLoans = 0;
    public $durationProgress = 0;

    // Tab
    public $activeTab = 'overview';

    public function mount($circleId)
    {
        $this->circleId = $circleId;

        $this->circle = Circle::with([
            'creator',
            'villageBank',
            'members',
            'months.loans.borrower',
            'insuranceConfig',
            'shareout',
        ])->withCount('members', 'months')->findOrFail($circleId);

        $this->totalMembers = $this->circle->members_count;
        $this->totalMonths  = $this->circle->months_count;

        // Aggregate loan data across all months
        $allLoans = collect();
        foreach ($this->circle->months as $month) {
            $allLoans = $allLoans->merge($month->loans);
        }

        $this->totalLoans      = $allLoans->count();
        $this->totalLoanAmount = $allLoans->sum('amount');
        $this->activeLoans     = $allLoans->whereIn('status', ['approved', 'active', 'pending'])->count();
        $this->completedLoans  = $allLoans->where('status', 'completed')->count();

        // Duration progress
        if ($this->circle->start_date && $this->circle->end_date) {
            $totalDays   = $this->circle->start_date->diffInDays($this->circle->end_date);
            $elapsedDays = $this->circle->start_date->diffInDays(now());
            $this->durationProgress = $totalDays > 0 ? min(100, ($elapsedDays / $totalDays) * 100) : 0;
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        $months  = $this->circle->months->sortByDesc('start_date');
        $members = $this->circle->members;

        // Collect all loans across all months
        $allLoans = collect();
        foreach ($this->circle->months as $month) {
            foreach ($month->loans as $loan) {
                $loan->month_name = $month->name ?? 'Month ' . $month->id;
                $allLoans->push($loan);
            }
        }

        return view('livewire.village-banking.circles.circle-show', [
            'months'   => $months,
            'members'  => $members,
            'allLoans' => $allLoans,
        ])->layout('layouts.main.master-livewire');
    }
}
