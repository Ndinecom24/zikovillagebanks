<?php

namespace App\Livewire\Subscription;

use App\Models\Subscription\License;
use App\Models\Subscription\Subscription;
use App\Models\Subscription\SubscriptionPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentReview extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $statusFilter = 'pending';
    public $perPage = 10;

    public $showReviewModal = false;
    public $reviewPaymentId = null;
    public $reviewAction = '';
    public $adminRemarks = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function openReview($id, $action)
    {
        $this->reviewPaymentId = $id;
        $this->reviewAction = $action;
        $this->adminRemarks = '';
        $this->showReviewModal = true;
    }

    public function submitReview()
    {
        $this->validate([
            'adminRemarks' => $this->reviewAction === 'reject' ? 'required|string|max:500' : 'nullable|string|max:500',
        ]);

        $payment = SubscriptionPayment::with('subscription.plan')->findOrFail($this->reviewPaymentId);

        if ($payment->status !== 'pending') {
            session()->flash('error', 'This payment has already been reviewed.');
            $this->showReviewModal = false;
            return;
        }

        if ($this->reviewAction === 'confirm') {
            $this->confirmPayment($payment);
        } else {
            $this->rejectPayment($payment);
        }

        $this->showReviewModal = false;
        $this->reset(['reviewPaymentId', 'adminRemarks', 'reviewAction']);
    }

    private function confirmPayment(SubscriptionPayment $payment)
    {
        DB::transaction(function () use ($payment) {
            // 1. Confirm payment
            $payment->update([
                'status'       => 'confirmed',
                'admin_remarks' => $this->adminRemarks ?: 'Payment confirmed.',
                'reviewed_by'  => Auth::id(),
                'reviewed_at'  => now(),
            ]);

            // 2. Activate / extend subscription
            $subscription = $payment->subscription;
            $plan = $subscription->plan;

            $startsAt = $subscription->isActive() ? $subscription->ends_at : now();
            $endsAt = $startsAt->copy()->addDays($plan->duration_days);

            $subscription->update([
                'status'    => 'active',
                'starts_at' => $subscription->isActive() ? $subscription->starts_at : now(),
                'ends_at'   => $endsAt,
            ]);

            // 3. Generate / extend license
            $existingLicense = License::where('subscription_id', $subscription->id)
                ->where('status', 'active')
                ->first();

            if ($existingLicense) {
                $existingLicense->update(['expires_at' => $endsAt]);
            } else {
                License::create([
                    'village_bank_id'  => $subscription->village_bank_id,
                    'subscription_id'  => $subscription->id,
                    'license_key'      => License::generateKey(),
                    'status'           => 'active',
                    'issued_at'        => now(),
                    'expires_at'       => $endsAt,
                ]);
            }
        });

        session()->flash('success', 'Payment confirmed! Subscription and license have been activated/extended.');
    }

    private function rejectPayment(SubscriptionPayment $payment)
    {
        $payment->update([
            'status'       => 'rejected',
            'admin_remarks' => $this->adminRemarks,
            'reviewed_by'  => Auth::id(),
            'reviewed_at'  => now(),
        ]);

        session()->flash('success', 'Payment rejected.');
    }

    public function render()
    {
        $payments = SubscriptionPayment::with([
                'subscription.villageBank',
                'subscription.plan',
                'payer',
                'reviewer',
            ])
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('reference', 'like', '%' . $this->search . '%')
                       ->orWhereHas('subscription.villageBank', function ($q3) {
                           $q3->where('name', 'like', '%' . $this->search . '%');
                       })
                       ->orWhereHas('payer', function ($q3) {
                           $q3->where('name', 'like', '%' . $this->search . '%');
                       });
                });
            })
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.subscription.payment-review', compact('payments'));
    }
}
