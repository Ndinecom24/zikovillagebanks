<?php

namespace App\Http\Livewire\VillageBanking\Payments;

use App\Models\VillageBanking\Transaction;
use App\Traits\HasVillageBankScope;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentConfirmation extends Component
{
    use WithPagination, HasVillageBankScope;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $statusFilter = 'pending';
    public $perPage = 15;

    // Review
    public $reviewTxn;
    public $remarks = '';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatusFilter() { $this->resetPage(); }

    public function openReview($id)
    {
        $this->reviewTxn = Transaction::with(['sender', 'receiver', 'loan', 'month.circle', 'paymentMethod'])->findOrFail($id);
        $this->remarks = '';
    }

    public function closeReview()
    {
        $this->reset(['reviewTxn', 'remarks']);
    }

    public function confirm()
    {
        $txn = Transaction::findOrFail($this->reviewTxn->id);
        $txn->update(['status' => 'confirmed']);
        $this->closeReview();
        session()->flash('message', 'Payment confirmed.');
    }

    public function reject()
    {
        $txn = Transaction::findOrFail($this->reviewTxn->id);
        $txn->update(['status' => 'rejected']);
        $this->closeReview();
        session()->flash('warning', 'Payment rejected.');
    }

    public function render()
    {
        $monthIds = $this->scopedMonthIds();

        $query = Transaction::with(['sender', 'receiver', 'paymentMethod', 'month.circle'])
            ->whereIn('month_id', $monthIds);

        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->whereHas('sender', fn ($s) => $s->where('name', 'like', $term))
                  ->orWhereHas('receiver', fn ($r) => $r->where('name', 'like', $term));
            });
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate($this->perPage);

        $pendingCount   = Transaction::whereIn('month_id', $monthIds)->where('status', 'pending')->count();
        $confirmedCount = Transaction::whereIn('month_id', $monthIds)->where('status', 'confirmed')->count();
        $totalConfirmed = Transaction::whereIn('month_id', $monthIds)->where('status', 'confirmed')->sum('amount');

        return view('livewire.village-banking.payments.payment-confirmation', compact(
            'transactions', 'pendingCount', 'confirmedCount', 'totalConfirmed',
        ))->layout('layouts.main.master-livewire');
    }
}
