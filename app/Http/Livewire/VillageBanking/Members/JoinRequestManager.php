<?php

namespace App\Http\Livewire\VillageBanking\Members;

use App\Models\User;
use App\Models\VillageBanking\JoinRequest;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankMember;
use App\Services\LicenseEnforcement;
use App\Traits\HasVillageBankScope;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class JoinRequestManager extends Component
{
    use HasVillageBankScope;

    public $statusFilter = 'pending';

    /* ── Approval / Rejection ──────────── */
    public $showActionModal = false;
    public $actionRequestId = null;
    public $actionType      = '';  // approve | reject
    public $adminRemarks    = '';
    public $assignGuarantor = '';  // admin can assign guarantor username

    /* ── View detail ───────────────────── */
    public $showDetailId    = null;

    /* ── Actions ───────────────────────── */

    public function openAction(int $requestId, string $type)
    {
        $this->actionRequestId = $requestId;
        $this->actionType      = $type;
        $this->adminRemarks    = '';
        $this->assignGuarantor = '';
        $this->showActionModal = true;

        // Pre-fill guarantor if already set
        $req = JoinRequest::find($requestId);
        if ($req && $req->guarantor_username) {
            $this->assignGuarantor = $req->guarantor_username;
        }
    }

    public function closeAction()
    {
        $this->showActionModal = false;
        $this->actionRequestId = null;
    }

    public function processAction()
    {
        $request = JoinRequest::with('user')->findOrFail($this->actionRequestId);

        if ($this->actionType === 'approve') {
            // Enforce member limit before approving
            $check = LicenseEnforcement::forBank($request->village_bank_id)->canAddMembers();
            if (!$check['allowed']) {
                $this->closeAction();
                session()->flash('error', $check['message']);
                return;
            }

            // Resolve guarantor
            $guarantorId = $request->guarantor_id;
            if (!empty($this->assignGuarantor)) {
                $guarantor = User::where('username', $this->assignGuarantor)->first();
                if ($guarantor) {
                    $guarantorId = $guarantor->id;
                }
            }

            $request->update([
                'status'             => 'approved',
                'guarantor_username' => $this->assignGuarantor ?: $request->guarantor_username,
                'guarantor_id'       => $guarantorId,
                'admin_remarks'      => $this->adminRemarks ?: null,
                'reviewed_by'        => Auth::id(),
                'reviewed_at'        => Carbon::now(),
            ]);

            // Add user as member of the village bank
            $exists = VillageBankMember::where('village_bank_id', $request->village_bank_id)
                ->where('user_id', $request->user_id)
                ->exists();

            if (!$exists) {
                VillageBankMember::create([
                    'village_bank_id' => $request->village_bank_id,
                    'user_id'         => $request->user_id,
                    'role'            => 'member',
                    'joined_at'       => Carbon::now(),
                ]);
            }

            // Update user's guarantor_id if set
            if ($guarantorId) {
                $request->user->update(['guarantor_id' => $guarantorId]);
            }

            session()->flash('message', $request->user->name . ' has been approved and added as a member.');
        } else {
            $request->update([
                'status'        => 'rejected',
                'admin_remarks' => $this->adminRemarks ?: null,
                'reviewed_by'   => Auth::id(),
                'reviewed_at'   => Carbon::now(),
            ]);

            session()->flash('message', $request->user->name . '\'s request has been rejected.');
        }

        $this->closeAction();
    }

    /* ── Assign guarantor to pending request ── */

    public function assignGuarantorToRequest(int $requestId, string $username)
    {
        $request = JoinRequest::findOrFail($requestId);
        $guarantor = User::where('username', $username)->first();

        $request->update([
            'guarantor_username' => $username,
            'guarantor_id'       => $guarantor?->id,
        ]);

        session()->flash('message', 'Guarantor updated.');
    }

    /* ── Toggle detail ─────────────────── */

    public function toggleDetail(int $id)
    {
        $this->showDetailId = $this->showDetailId === $id ? null : $id;
    }

    /* ── Computed ───────────────────────── */

    public function getRequestsProperty()
    {
        $bankId = session('current_village_bank_id');

        $query = JoinRequest::with(['user', 'villageBank', 'guarantor', 'reviewer'])
            ->where('status', $this->statusFilter)
            ->orderByDesc('created_at');

        if ($bankId) {
            $query->where('village_bank_id', $bankId);
        }

        return $query->get();
    }

    public function getCountsProperty()
    {
        $bankId = session('current_village_bank_id');

        $base = JoinRequest::query();
        if ($bankId) {
            $base->where('village_bank_id', $bankId);
        }

        return [
            'pending'  => (clone $base)->where('status', 'pending')->count(),
            'approved' => (clone $base)->where('status', 'approved')->count(),
            'rejected' => (clone $base)->where('status', 'rejected')->count(),
        ];
    }

    public function render()
    {
        return view('livewire.village-banking.members.join-request-manager', [
            'requests' => $this->requests,
            'counts'   => $this->counts,
        ])->layout('layouts.main.master-livewire');
    }
}
