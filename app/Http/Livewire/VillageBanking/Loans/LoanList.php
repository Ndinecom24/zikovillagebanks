<?php

namespace App\Http\Livewire\VillageBanking\Loans;

use App\Models\VillageBanking\Loan;
use App\Traits\HasVillageBankScope;
use Livewire\Component;
use Livewire\WithPagination;

class LoanList extends Component
{
    use WithPagination, HasVillageBankScope;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $statusFilter = '';
    public $perPage = 15;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search'         => ['except' => ''],
        'statusFilter'   => ['except' => '', 'as' => 'status'],
        'villageBankId'  => ['except' => '', 'as' => 'bank'],
    ];

    public function updatingSearch()  { $this->resetPage(); }
    public function updatingStatusFilter() { $this->resetPage(); }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $monthIds = $this->scopedMonthIds();

        $query = Loan::with(['borrower', 'month.circle'])
            ->withCount('pairings')
            ->whereIn('month_id', $monthIds);

        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->whereHas('borrower', fn ($b) => $b->where('name', 'like', $term))
                  ->orWhereHas('month.circle', fn ($c) => $c->where('name', 'like', $term));
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);
        $loans = $query->paginate($this->perPage);

        // Stats (scoped)
        $totalLoans     = Loan::whereIn('month_id', $monthIds)->count();
        $pendingLoans   = Loan::whereIn('month_id', $monthIds)->where('status', 'pending')->count();
        $activeLoans    = Loan::whereIn('month_id', $monthIds)->where('status', 'active')->count();
        $totalDisbursed = Loan::whereIn('month_id', $monthIds)->whereIn('status', ['active', 'completed'])->sum('amount');

        return view('livewire.village-banking.loans.loan-list', compact(
            'loans', 'totalLoans', 'pendingLoans', 'activeLoans', 'totalDisbursed',
        ))->layout('layouts.main.master-livewire');
    }
}
