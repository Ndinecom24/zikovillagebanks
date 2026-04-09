<?php

namespace App\Http\Livewire\VillageBanking\Loans;

use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\LoanApproval as LoanApprovalModel;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class LoanApproval extends Component
{
    use WithPagination, HasVillageBankScope;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 15;

    // Review
    public $reviewLoan;
    public $remarks = '';

    public function updatingSearch() { $this->resetPage(); }

    public function openReview($loanId)
    {
        $this->reviewLoan = Loan::with(['borrower', 'month.circle', 'approvals.approver'])->findOrFail($loanId);
        $this->remarks = '';
    }

    public function closeReview()
    {
        $this->reset(['reviewLoan', 'remarks']);
    }

    public function approve()
    {
        $loan = Loan::findOrFail($this->reviewLoan->id);

        LoanApprovalModel::create([
            'loan_id'     => $loan->id,
            'approved_by' => Auth::id(),
            'status'      => 'approved',
            'remarks'     => $this->remarks ?: null,
        ]);

        $loan->update(['status' => 'approved']);

        $this->closeReview();
        session()->flash('message', 'Loan approved successfully.');
    }

    public function reject()
    {
        $this->validate([
            'remarks' => 'required|string|min:5',
        ], [
            'remarks.required' => 'Provide a reason for rejection.',
            'remarks.min'      => 'Reason must be at least 5 characters.',
        ]);

        $loan = Loan::findOrFail($this->reviewLoan->id);

        LoanApprovalModel::create([
            'loan_id'     => $loan->id,
            'approved_by' => Auth::id(),
            'status'      => 'rejected',
            'remarks'     => $this->remarks,
        ]);

        $loan->update(['status' => 'rejected']);

        $this->closeReview();
        session()->flash('warning', 'Loan rejected.');
    }

    public function render()
    {
        $monthIds = $this->scopedMonthIds();

        $query = Loan::with(['borrower', 'month.circle'])
            ->where('status', 'pending')
            ->whereIn('month_id', $monthIds);

        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->whereHas('borrower', fn ($b) => $b->where('name', 'like', $term));
        }

        $pendingLoans = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        $pendingCount = Loan::where('status', 'pending')->whereIn('month_id', $monthIds)->count();

        return view('livewire.village-banking.loans.loan-approval', compact(
            'pendingLoans', 'pendingCount',
        ))->layout('layouts.main.master-livewire');
    }
}
