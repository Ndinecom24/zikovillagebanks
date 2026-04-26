<?php

namespace App\Livewire\VillageBanking\Communications;

use App\Models\User;
use App\Models\VillageBanking\Communication;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankConfiguration;
use App\Services\CommunicationService;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.main.master-livewire')]
class CommunicationManager extends Component
{
    use WithPagination, HasVillageBankScope;

    protected $paginationTheme = 'bootstrap';

    /* ── Filters ── */
    public $search = '';
    public $channelFilter = '';
    public $perPage = 15;

    /* ── Compose modal ── */
    public $showComposeModal = false;
    public $composeChannel = 'email';
    public $composeSubject = '';
    public $composeMessage = '';
    public $composeRecipientType = 'all';  // all | selected
    public $composeSelectedMembers = [];
    public $composeSending = false;

    /* ── Detail modal ── */
    public $showDetailModal = false;
    public $detailCommId = null;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedChannelFilter()
    {
        $this->resetPage();
    }

    /* ═══════════════════════════════════════════
     *  Compose
     * ═══════════════════════════════════════════ */

    public function openCompose()
    {
        $bankId = $this->activeBankId();
        if (empty($bankId)) {
            session()->flash('error', 'Please select a village bank first.');
            return;
        }

        $allowed = CommunicationService::allowedChannels($bankId);
        if (empty($allowed)) {
            session()->flash('error', 'Communications are disabled for this village bank. Enable them in Bank Configuration → Communications.');
            return;
        }

        $this->reset(['composeChannel', 'composeSubject', 'composeMessage', 'composeRecipientType', 'composeSelectedMembers', 'composeSending']);
        $this->composeChannel = $allowed[0]; // default to first allowed channel
        $this->showComposeModal = true;
    }

    public function closeCompose()
    {
        $this->showComposeModal = false;
    }

    public function sendMessage()
    {
        $rules = [
            'composeMessage' => 'required|string|min:1|max:2000',
            'composeChannel' => 'required|in:email,sms',
            'composeRecipientType' => 'required|in:all,selected',
        ];

        if ($this->composeChannel === 'email') {
            $rules['composeSubject'] = 'required|string|max:255';
        }

        if ($this->composeRecipientType === 'selected') {
            $rules['composeSelectedMembers'] = 'required|array|min:1';
        }

        $this->validate($rules, [
            'composeMessage.required'          => 'Enter the message content.',
            'composeSubject.required'          => 'Enter the email subject.',
            'composeSelectedMembers.required'  => 'Select at least one member.',
            'composeSelectedMembers.min'       => 'Select at least one member.',
        ]);

        $bankId = $this->activeBankId();

        // Verify channel is allowed
        $allowed = CommunicationService::allowedChannels($bankId);
        if (!in_array($this->composeChannel, $allowed)) {
            session()->flash('error', ucfirst($this->composeChannel) . ' is not enabled for this village bank.');
            return;
        }

        $this->composeSending = true;

        try {
            $recipientIds = $this->composeRecipientType === 'selected'
                ? $this->composeSelectedMembers
                : null;

            $comm = CommunicationService::send(
                villageBankId: $bankId,
                channel: $this->composeChannel,
                message: $this->composeMessage,
                subject: $this->composeChannel === 'email' ? $this->composeSubject : null,
                recipientIds: $recipientIds,
                sentBy: Auth::id(),
            );

            if ($comm->failed_count === 0) {
                session()->flash('success', ucfirst($this->composeChannel) . " sent to {$comm->sent_count} member(s) successfully!");
            } else {
                session()->flash('warning', "Sent to {$comm->sent_count} member(s), but {$comm->failed_count} failed. Check the log for details.");
            }
        } catch (\Throwable $e) {
            session()->flash('error', 'Failed to send: ' . $e->getMessage());
        }

        $this->composeSending = false;
        $this->showComposeModal = false;
    }

    /* ═══════════════════════════════════════════
     *  Detail
     * ═══════════════════════════════════════════ */

    public function viewDetail($id)
    {
        $this->detailCommId = $id;
        $this->showDetailModal = true;
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->detailCommId = null;
    }

    /* ═══════════════════════════════════════════
     *  Render
     * ═══════════════════════════════════════════ */

    public function render()
    {
        $bankId = $this->activeBankId();

        $communications = Communication::with(['sender', 'villageBank'])
            ->when($bankId, fn ($q) => $q->where('village_bank_id', $bankId))
            ->when($this->channelFilter, fn ($q) => $q->where('channel', $this->channelFilter))
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('subject', 'like', '%' . $this->search . '%')
                       ->orWhere('message', 'like', '%' . $this->search . '%');
                });
            })
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        $stats = Communication::query()
            ->when($bankId, fn ($q) => $q->where('village_bank_id', $bankId));

        $statsData = [
            'total'      => (clone $stats)->count(),
            'emails'     => (clone $stats)->where('channel', 'email')->count(),
            'sms'        => (clone $stats)->where('channel', 'sms')->count(),
            'this_month' => (clone $stats)->whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->count(),
        ];

        // Allowed channels for this bank
        $allowedChannels = $bankId ? CommunicationService::allowedChannels($bankId) : [];

        // Members for recipient selection
        $members = collect();
        if ($this->showComposeModal && $bankId) {
            $members = VillageBank::find($bankId)?->members()
                ->orderBy('name')
                ->get(['users.id', 'users.name', 'users.email', 'users.mobile_no']) ?? collect();
        }

        // Detail record
        $detailComm = null;
        if ($this->showDetailModal && $this->detailCommId) {
            $detailComm = Communication::with(['sender', 'villageBank'])->find($this->detailCommId);
            if (!$detailComm) {
                $this->showDetailModal = false;
                $this->detailCommId = null;
            }
        }

        return view('livewire.village-banking.communications.communication-manager', compact(
            'communications', 'statsData', 'allowedChannels', 'members', 'detailComm'
        ));
    }
}
