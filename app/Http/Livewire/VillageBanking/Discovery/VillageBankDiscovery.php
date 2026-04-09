<?php

namespace App\Http\Livewire\VillageBanking\Discovery;

use App\Models\User;
use App\Models\VillageBanking\JoinRequest;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class VillageBankDiscovery extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    /* ── Join request form ── */
    public $showJoinModal     = false;
    public $joinBankId        = null;
    public $joinBankName      = '';
    public $joinMessage       = '';
    public $joinGuarantor     = '';  // guarantor username (optional)

    /* ── Detail modal ── */
    public $showDetailModal   = false;
    public $detailBank        = null;

    /* ── Guarantor update (post-approval) ── */
    public $showGuarantorModal = false;
    public $guarantorRequestId = null;
    public $guarantorUsername   = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* ── Open detail view ── */

    public function viewBank(int $bankId)
    {
        $this->detailBank = VillageBank::withCount(['members', 'circles'])
            ->with('configuration')
            ->find($bankId);
        $this->showDetailModal = true;
    }

    /* ── Open join modal ── */

    public function openJoinModal(int $bankId, string $bankName)
    {
        $this->joinBankId    = $bankId;
        $this->joinBankName  = $bankName;
        $this->joinMessage   = '';
        $this->joinGuarantor = '';
        $this->showJoinModal = true;
    }

    /* ── Submit join request ── */

    public function submitJoinRequest()
    {
        $this->validate([
            'joinBankId'    => 'required|exists:village_banks,id',
            'joinMessage'   => 'nullable|string|max:500',
            'joinGuarantor' => 'nullable|string|max:100',
        ]);

        $userId = Auth::id();

        // Check if already a member
        $isMember = VillageBank::find($this->joinBankId)
            ->members()
            ->where('users.id', $userId)
            ->exists();

        if ($isMember) {
            session()->flash('warning', 'You are already a member of this village bank.');
            $this->showJoinModal = false;
            return;
        }

        // Check for existing pending request
        $existingPending = JoinRequest::where('user_id', $userId)
            ->where('village_bank_id', $this->joinBankId)
            ->where('status', 'pending')
            ->exists();

        if ($existingPending) {
            session()->flash('warning', 'You already have a pending request for this village bank.');
            $this->showJoinModal = false;
            return;
        }

        // Resolve guarantor username if provided
        $guarantorId = null;
        if (!empty($this->joinGuarantor)) {
            $guarantor = User::where('username', trim($this->joinGuarantor))->first();
            if ($guarantor) {
                $guarantorId = $guarantor->id;
            }
            // If not found, still store the username — admin can resolve later
        }

        JoinRequest::create([
            'user_id'             => $userId,
            'village_bank_id'     => $this->joinBankId,
            'status'              => 'pending',
            'guarantor_username'  => $this->joinGuarantor ?: null,
            'guarantor_id'        => $guarantorId,
            'message'             => $this->joinMessage ?: null,
        ]);

        $this->showJoinModal = false;
        session()->flash('message', 'Your request to join "' . $this->joinBankName . '" has been submitted. You will be notified once reviewed.');
    }

    /* ── Add guarantor to an approved-but-no-guarantor request ── */

    public function openGuarantorModal(int $requestId)
    {
        $this->guarantorRequestId = $requestId;
        $this->guarantorUsername   = '';
        $this->showGuarantorModal  = true;
    }

    public function saveGuarantor()
    {
        $this->validate([
            'guarantorUsername' => 'required|string|max:100',
        ]);

        $request = JoinRequest::where('id', $this->guarantorRequestId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $guarantor = User::where('username', trim($this->guarantorUsername))->first();

        $request->update([
            'guarantor_username' => trim($this->guarantorUsername),
            'guarantor_id'       => $guarantor?->id,
        ]);

        // Also update the user's guarantor_id on the users table if resolved
        if ($guarantor) {
            Auth::user()->update(['guarantor_id' => $guarantor->id]);
        }

        $this->showGuarantorModal = false;
        session()->flash('message', 'Guarantor updated successfully.' . ($guarantor ? '' : ' The username will be verified by an admin.'));
    }

    /* ── Computed ── */

    public function getMyRequestsProperty()
    {
        return JoinRequest::with(['villageBank', 'guarantor'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
    }

    public function render()
    {
        $userId = Auth::id();

        // Get IDs the user already belongs to or has pending requests for
        $memberBankIds  = Auth::user()->villageBanks()->pluck('village_banks.id')->toArray();
        $pendingBankIds = JoinRequest::where('user_id', $userId)
            ->where('status', 'pending')
            ->pluck('village_bank_id')->toArray();

        $banks = VillageBank::where('status', 'active')
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('name', 'like', '%' . $this->search . '%')
                       ->orWhere('code', 'like', '%' . $this->search . '%')
                       ->orWhere('address', 'like', '%' . $this->search . '%');
                });
            })
            ->withCount(['members', 'circles'])
            ->orderBy('name')
            ->paginate(12);

        return view('livewire.village-banking.discovery.village-bank-discovery', [
            'banks'          => $banks,
            'memberBankIds'  => $memberBankIds,
            'pendingBankIds' => $pendingBankIds,
            'myRequests'     => $this->myRequests,
        ])->layout('layouts.main.master-livewire');
    }
}
