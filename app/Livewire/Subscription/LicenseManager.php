<?php

namespace App\Livewire\Subscription;

use App\Models\Subscription\License;
use App\Models\Subscription\Subscription;
use App\Models\Subscription\SubscriptionPayment;
use App\Models\VillageBanking\VillageBankMember;
use App\Models\VillageBanking\Circle;
use App\Services\LicenseEnforcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class LicenseManager extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $statusFilter = '';
    public $perPage = 10;

    /* ── Revoke modal ── */
    public $showRevokeModal = false;
    public $revokeLicenseId = null;
    public $revokeReason = '';

    /* ── Detail modal ── */
    public $showDetailModal = false;
    public $detailLicenseId = null;
    public $detailUsage = null;
    public $detailPayments = [];

    /* ── Activate modal ── */
    public $showActivateModal = false;
    public $activateLicenseId = null;
    public $activateDays = 365;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    /* ── Detail actions ── */

    public function viewDetail($id)
    {
        $this->detailLicenseId = $id;
        $license = License::with([
            'villageBank',
            'subscription.plan',
            'subscription.payments.payer',
        ])->findOrFail($id);

        // Usage stats
        $this->detailUsage = null;
        if ($license->village_bank_id) {
            $enforcement = LicenseEnforcement::forBank($license->village_bank_id);
            $this->detailUsage = $enforcement->usageSummary();
        }

        // Recent payments
        $this->detailPayments = [];
        if ($license->subscription) {
            $this->detailPayments = SubscriptionPayment::where('subscription_id', $license->subscription_id)
                ->with(['payer', 'reviewer'])
                ->orderByDesc('created_at')
                ->limit(10)
                ->get()
                ->toArray();
        }

        $this->showDetailModal = true;
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->reset(['detailLicenseId', 'detailUsage', 'detailPayments']);
    }

    /**
     * Close detail modal and open revoke modal for the same license.
     */
    public function revokeFromDetail()
    {
        $id = $this->detailLicenseId;
        $this->closeDetail();
        $this->openRevoke($id);
    }

    /**
     * Close detail modal and open activate modal for the same license.
     */
    public function activateFromDetail()
    {
        $id = $this->detailLicenseId;
        $this->closeDetail();
        $this->openActivate($id);
    }

    /* ── Revoke actions ── */

    public function openRevoke($id)
    {
        $this->revokeLicenseId = $id;
        $this->revokeReason = '';
        $this->showRevokeModal = true;
    }

    public function revokeLicense()
    {
        $this->validate([
            'revokeReason' => 'required|string|max:500',
        ], [
            'revokeReason.required' => 'Please provide a reason for revocation.',
        ]);

        $license = License::findOrFail($this->revokeLicenseId);
        $license->update([
            'status'        => 'revoked',
            'revoked_at'    => now(),
            'revoke_reason' => $this->revokeReason,
        ]);

        // Also expire the subscription
        if ($license->subscription) {
            $license->subscription->update(['status' => 'cancelled']);
        }

        $this->showRevokeModal = false;
        $this->reset(['revokeLicenseId', 'revokeReason']);
        session()->flash('success', 'License revoked successfully.');
    }

    /* ── Activate / Reactivate actions ── */

    public function openActivate($id)
    {
        $this->activateLicenseId = $id;
        $license = License::with('subscription.plan')->findOrFail($id);
        $this->activateDays = $license->subscription && $license->subscription->plan
            ? $license->subscription->plan->duration_days
            : 365;
        $this->showActivateModal = true;
    }

    public function activateLicense()
    {
        $this->validate([
            'activateDays' => 'required|integer|min:1|max:3650',
        ]);

        $license = License::with('subscription')->findOrFail($this->activateLicenseId);

        DB::transaction(function () use ($license) {
            $now = now();
            $expiresAt = $now->copy()->addDays($this->activateDays);

            $license->update([
                'status'       => 'active',
                'issued_at'    => $now,
                'expires_at'   => $expiresAt,
                'revoked_at'   => null,
                'revoke_reason' => null,
            ]);

            if ($license->subscription) {
                $license->subscription->update([
                    'status'    => 'active',
                    'starts_at' => $now,
                    'ends_at'   => $expiresAt,
                ]);
            }
        });

        $this->showActivateModal = false;
        $this->reset(['activateLicenseId', 'activateDays']);
        session()->flash('success', 'License activated successfully for ' . $this->activateDays . ' days.');
    }

    public function render()
    {
        $licenses = License::with(['villageBank', 'subscription.plan'])
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('license_key', 'like', '%' . $this->search . '%')
                       ->orWhereHas('villageBank', function ($q3) {
                           $q3->where('name', 'like', '%' . $this->search . '%');
                       });
                });
            })
            ->orderByDesc('issued_at')
            ->paginate($this->perPage);

        $stats = [
            'total'    => License::count(),
            'active'   => License::where('status', 'active')->count(),
            'expired'  => License::where('status', 'expired')->count(),
            'revoked'  => License::where('status', 'revoked')->count(),
            'expiring' => License::where('status', 'active')
                              ->where('expires_at', '<=', now()->addDays(14))
                              ->where('expires_at', '>', now())
                              ->count(),
        ];

        // Revenue summary
        $revenue = [
            'total'     => SubscriptionPayment::where('status', 'confirmed')->sum('amount'),
            'pending'   => SubscriptionPayment::where('status', 'pending')->sum('amount'),
            'thisMonth' => SubscriptionPayment::where('status', 'confirmed')
                              ->whereMonth('reviewed_at', now()->month)
                              ->whereYear('reviewed_at', now()->year)
                              ->sum('amount'),
        ];

        // Load detail license fresh each render (avoid storing Eloquent model as public property)
        $detailLicense = null;
        if ($this->showDetailModal && $this->detailLicenseId) {
            $detailLicense = License::with(['villageBank', 'subscription.plan'])->find($this->detailLicenseId);
            if (!$detailLicense) {
                $this->showDetailModal = false;
                $this->detailLicenseId = null;
            }
        }

        return view('livewire.subscription.license-manager', compact('licenses', 'stats', 'revenue', 'detailLicense'));
    }
}
