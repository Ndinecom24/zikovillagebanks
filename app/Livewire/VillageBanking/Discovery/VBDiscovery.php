<?php

namespace App\Livewire\VillageBanking\Discovery;

use App\Models\VillageBanking\JoinRequest;
use App\Models\VillageBanking\VillageBank;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class VBDiscovery extends Component
{
    public $search = '';

    /* ── Join-request form ──────────────── */
    public $showJoinModal      = false;
    public $joinBankId         = null;
    public $joinBank           = null;
    public $guarantorUsername   = '';
    public $joinMessage        = '';

    /* ── Detail view ────────────────────── */
    public $showDetailModal    = false;
    public $detailBank         = null;

    /* ── My requests ────────────────────── */
    public $showMyRequests     = false;

    /* ── Lifecycle ──────────────────────── */

    public function updatedSearch()
    {
        // reactive search
    }

    /* ── View bank details ──────────────── */

    public function viewBank(int $bankId)
    {
        $this->detailBank = VillageBank::withCount(['members', 'circles'])
            ->with('configuration')
            ->find($bankId);

        $this->showDetailModal = true;
        $this->showJoinModal   = false;
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->detailBank      = null;
    }

    /* ── Open join modal ────────────────── */

    public function openJoinModal(int $bankId)
    {
        $this->joinBankId       = $bankId;
        $this->joinBank         = VillageBank::find($bankId);
        $this->guarantorUsername = '';
        $this->joinMessage      = '';
        $this->showJoinModal    = true;
        $this->showDetailModal  = false;
    }

    public function closeJoinModal()
    {
        $this->showJoinModal = false;
        $this->joinBankId    = null;
        $this->joinBank      = null;
    }

    /* ── Submit join request ────────────── */

    public function submitJoinRequest()
    {
        $this->validate([
            'joinBankId'       => 'required|exists:village_banks,id',
            'guarantorUsername' => 'nullable|string|max:100',
            'joinMessage'      => 'nullable|string|max:500',
        ]);

        $userId = Auth::id();

        // Check if already a member
        $alreadyMember = VillageBank::find($this->joinBankId)
            ->members()
            ->where('users.id', $userId)
            ->exists();

        if ($alreadyMember) {
            session()->flash('warning', 'You are already a member of this village bank.');
            $this->closeJoinModal();
            return;
        }

        // Check for existing pending request
        $existing = JoinRequest::where('user_id', $userId)
            ->where('village_bank_id', $this->joinBankId)
            ->where('status', 'pending')
            ->exists();

        if ($existing) {
            session()->flash('warning', 'You already have a pending request for this village bank.');
            $this->closeJoinModal();
            return;
        }

        // Resolve guarantor if provided
        $guarantorId = null;
        if (!empty($this->guarantorUsername)) {
            $guarantor = \App\Models\User::where('username', $this->guarantorUsername)->first();
            if ($guarantor) {
                $guarantorId = $guarantor->id;
            }
        }

        JoinRequest::create([
            'user_id'            => $userId,
            'village_bank_id'    => $this->joinBankId,
            'status'             => 'pending',
            'guarantor_username' => $this->guarantorUsername ?: null,
            'guarantor_id'       => $guarantorId,
            'message'            => $this->joinMessage ?: null,
        ]);

        $this->closeJoinModal();
        session()->flash('message', 'Your request to join has been submitted! The admin will review it shortly.');
    }

    /* ── Toggle my requests ─────────────── */

    public function toggleMyRequests()
    {
        $this->showMyRequests = !$this->showMyRequests;
    }

    /* ── Update guarantor on existing request ── */

    public function updateGuarantor(int $requestId, string $username)
    {
        $request = JoinRequest::where('id', $requestId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$request) return;

        $guarantor = \App\Models\User::where('username', $username)->first();

        $request->update([
            'guarantor_username' => $username,
            'guarantor_id'       => $guarantor?->id,
        ]);

        session()->flash('message', 'Guarantor updated for your request.');
    }

    /* ── Computed ───────────────────────── */

    public function getBanksProperty()
    {
        $userId = Auth::id();

        $query = VillageBank::where('status', 'active')
            ->withCount(['members', 'circles']);

        if (!empty($this->search)) {
            $s = '%' . $this->search . '%';
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', $s)
                  ->orWhere('code', 'like', $s)
                  ->orWhere('address', 'like', $s)
                  ->orWhere('description', 'like', $s);
            });
        }

        return $query->orderBy('name')->limit(50)->get()->map(function ($bank) use ($userId) {
            $bank->is_member = $bank->members->contains('id', $userId);
            $bank->has_pending = JoinRequest::where('user_id', $userId)
                ->where('village_bank_id', $bank->id)
                ->where('status', 'pending')
                ->exists();
            return $bank;
        });
    }

    public function getMyRequestsProperty()
    {
        return JoinRequest::with(['villageBank', 'guarantor', 'reviewer'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.village-banking.discovery.vb-discovery', [
            'banks'      => $this->banks,
            'myRequests' => $this->myRequests,
        ]);
    }
}
