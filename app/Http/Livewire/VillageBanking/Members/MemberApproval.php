<?php

namespace App\Http\Livewire\VillageBanking\Members;

use App\Models\User;
use App\Services\LicenseEnforcement;
use Livewire\Component;
use Livewire\WithPagination;

class MemberApproval extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 15;

    // Review modal
    public $reviewId;
    public $reviewUser;
    public $remarks = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* ── Open review ─────────────────────── */

    public function openReview($id)
    {
        $this->reviewUser = User::with('guarantor')->findOrFail($id);
        $this->reviewId = $id;
        $this->remarks = '';
    }

    public function closeReview()
    {
        $this->reset(['reviewId', 'reviewUser', 'remarks']);
    }

    /* ── Approve ─────────────────────────── */

    public function approve()
    {        // Enforce member limit before approving
        $bankId = session('current_village_bank_id');
        if ($bankId) {
            $check = LicenseEnforcement::forBank($bankId)->canAddMembers();
            if (!$check['allowed']) {
                $this->closeReview();
                session()->flash('error', $check['message']);
                return;
            }
        }
        $user = User::findOrFail($this->reviewId);
        $user->update(['status' => 'active']);

        $this->closeReview();
        session()->flash('message', $user->name . ' has been approved.');
    }

    /* ── Reject (set back to suspended) ──── */

    public function reject()
    {
        $this->validate([
            'remarks' => 'required|string|min:5',
        ], [
            'remarks.required' => 'Please provide a reason for rejection.',
            'remarks.min' => 'Reason must be at least 5 characters.',
        ]);

        $user = User::findOrFail($this->reviewId);
        $user->update(['status' => 'suspended']);

        $this->closeReview();
        session()->flash('warning', $user->name . ' has been rejected.');
    }

    /* ── Render ───────────────────────────── */

    public function render()
    {
        $query = User::with('guarantor')
            ->where('status', 'pending');

        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('email', 'like', $term)
                  ->orWhere('phone', 'like', $term);
            });
        }

        $pendingMembers = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        $pendingCount = User::where('status', 'pending')->count();

        return view('livewire.village-banking.members.member-approval', compact(
            'pendingMembers',
            'pendingCount',
        ))->layout('layouts.main.master-livewire');
    }
}
