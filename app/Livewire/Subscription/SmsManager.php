<?php

namespace App\Livewire\Subscription;

use App\Models\SmsLog;
use App\Models\User;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankMember;
use App\Services\MtnSmsService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SmsManager extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /* ── Filters ── */
    public $search = '';
    public $statusFilter = '';
    public $perPage = 15;

    /* ── Compose modal ── */
    public $showComposeModal = false;
    public $composeRecipient = '';
    public $composeMessage = '';
    public $composeSending = false;

    /* ── Bulk modal ── */
    public $showBulkModal = false;
    public $bulkTarget = 'all'; // all | bank | custom
    public $bulkBankId = '';
    public $bulkMessage = '';
    public $bulkCustomNumbers = '';
    public $bulkSending = false;

    /* ── Detail modal ── */
    public $showDetailModal = false;
    public $detailLogId = null;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    /* ═══════════════════════════════════════════
     *  Compose – Single SMS
     * ═══════════════════════════════════════════ */

    public function openCompose()
    {
        $this->reset(['composeRecipient', 'composeMessage', 'composeSending']);
        $this->showComposeModal = true;
    }

    public function closeCompose()
    {
        $this->showComposeModal = false;
    }

    public function sendSingle()
    {
        $this->validate([
            'composeRecipient' => 'required|string|min:9|max:15',
            'composeMessage'   => 'required|string|min:1|max:640',
        ], [
            'composeRecipient.required' => 'Enter the recipient phone number.',
            'composeMessage.required'   => 'Enter the message to send.',
        ]);

        $this->composeSending = true;

        try {
            $sms    = app(MtnSmsService::class);
            $result = $sms->sendOne($this->composeRecipient, $this->composeMessage);

            if ($result['success']) {
                session()->flash('success', 'SMS sent successfully! Transaction: ' . ($result['transactionId'] ?? 'N/A'));
            } else {
                session()->flash('error', 'SMS failed: ' . ($result['statusMessage'] ?? 'Unknown error'));
            }
        } catch (\Throwable $e) {
            session()->flash('error', 'SMS error: ' . $e->getMessage());
        }

        $this->composeSending = false;
        $this->showComposeModal = false;
    }

    /* ═══════════════════════════════════════════
     *  Bulk SMS
     * ═══════════════════════════════════════════ */

    public function openBulk()
    {
        $this->reset(['bulkTarget', 'bulkBankId', 'bulkMessage', 'bulkCustomNumbers', 'bulkSending']);
        $this->bulkTarget = 'all';
        $this->showBulkModal = true;
    }

    public function closeBulk()
    {
        $this->showBulkModal = false;
    }

    public function sendBulk()
    {
        $rules = [
            'bulkMessage' => 'required|string|min:1|max:640',
            'bulkTarget'  => 'required|in:all,bank,custom',
        ];

        if ($this->bulkTarget === 'bank') {
            $rules['bulkBankId'] = 'required|exists:village_banks,id';
        }

        if ($this->bulkTarget === 'custom') {
            $rules['bulkCustomNumbers'] = 'required|string|min:9';
        }

        $this->validate($rules, [
            'bulkMessage.required'       => 'Enter the message to send.',
            'bulkBankId.required'        => 'Select a village bank.',
            'bulkCustomNumbers.required' => 'Enter at least one phone number.',
        ]);

        $this->bulkSending = true;

        try {
            $recipients = $this->resolveBulkRecipients();

            if (empty($recipients)) {
                session()->flash('error', 'No valid recipients found.');
                $this->bulkSending = false;
                return;
            }

            $sms    = app(MtnSmsService::class);
            $result = $sms->sendBulk($recipients, $this->bulkMessage);

            if ($result['success']) {
                session()->flash('success', "Bulk SMS sent to {$result['totalSent']} recipients in {$result['batches']} batch(es).");
            } else {
                session()->flash('error', 'Some messages may have failed. Check the logs for details.');
            }
        } catch (\Throwable $e) {
            session()->flash('error', 'Bulk SMS error: ' . $e->getMessage());
        }

        $this->bulkSending = false;
        $this->showBulkModal = false;
    }

    protected function resolveBulkRecipients(): array
    {
        return match ($this->bulkTarget) {
            'all' => User::whereNotNull('mobile_no')
                ->where('mobile_no', '!=', '')
                ->pluck('mobile_no')
                ->toArray(),

            'bank' => User::whereIn('id',
                    VillageBankMember::where('village_bank_id', $this->bulkBankId)->pluck('user_id')
                )
                ->whereNotNull('mobile_no')
                ->where('mobile_no', '!=', '')
                ->pluck('mobile_no')
                ->toArray(),

            'custom' => array_filter(
                array_map('trim', preg_split('/[\n,;]+/', $this->bulkCustomNumbers)),
                fn ($n) => strlen($n) >= 9
            ),

            default => [],
        };
    }

    /* ═══════════════════════════════════════════
     *  Detail
     * ═══════════════════════════════════════════ */

    public function viewDetail($id)
    {
        $this->detailLogId = $id;
        $this->showDetailModal = true;
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->detailLogId = null;
    }

    /**
     * Retry a previously failed SMS.
     */
    public function retrySms($id)
    {
        $log = SmsLog::findOrFail($id);

        if ($log->status !== 'failed') {
            session()->flash('error', 'Only failed messages can be retried.');
            return;
        }

        try {
            $sms    = app(MtnSmsService::class);
            $result = $sms->sendOne($log->recipient, $log->message);

            if ($result['success']) {
                session()->flash('success', 'SMS retried successfully!');
            } else {
                session()->flash('error', 'Retry failed: ' . ($result['statusMessage'] ?? 'Unknown error'));
            }
        } catch (\Throwable $e) {
            session()->flash('error', 'Retry error: ' . $e->getMessage());
        }

        $this->closeDetail();
    }

    /* ═══════════════════════════════════════════
     *  Render
     * ═══════════════════════════════════════════ */

    public function render()
    {
        $logs = SmsLog::with('sender')
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('recipient', 'like', '%' . $this->search . '%')
                       ->orWhere('message', 'like', '%' . $this->search . '%')
                       ->orWhere('transaction_id', 'like', '%' . $this->search . '%');
                });
            })
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        $stats = [
            'total'      => SmsLog::count(),
            'sent'       => SmsLog::where('status', 'sent')->count(),
            'failed'     => SmsLog::where('status', 'failed')->count(),
            'today'      => SmsLog::whereDate('created_at', today())->count(),
            'this_month' => SmsLog::whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->count(),
        ];

        $villageBanks = VillageBank::orderBy('name')->pluck('name', 'id');

        // Detail log
        $detailLog = null;
        if ($this->showDetailModal && $this->detailLogId) {
            $detailLog = SmsLog::with('sender')->find($this->detailLogId);
            if (!$detailLog) {
                $this->showDetailModal = false;
                $this->detailLogId = null;
            }
        }

        return view('livewire.subscription.sms-manager', compact('logs', 'stats', 'villageBanks', 'detailLog'));
    }
}
