<?php

namespace App\Http\Livewire\Subscription;

use App\Models\Subscription\License;
use App\Models\Subscription\PaymentConfiguration;
use App\Models\Subscription\Subscription;
use App\Models\Subscription\SubscriptionPayment;
use App\Models\Subscription\SubscriptionPlan;
use App\Models\VillageBanking\VillageBank;
use App\Services\LicenseEnforcement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyLicense extends Component
{
    use WithFileUploads;

    /* ── Renewal modal ── */
    public $showRenewalModal = false;
    public $proofFile;
    public $paymentReference = '';
    public $selectedPlanId = null;

    /* ── Upgrade modal ── */
    public $showUpgradeModal = false;

    protected function rules()
    {
        return [
            'proofFile'        => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'paymentReference' => 'required|string|max:100',
        ];
    }

    protected $messages = [
        'proofFile.required'        => 'Please upload proof of payment.',
        'proofFile.mimes'           => 'Proof must be a JPG, PNG, or PDF file.',
        'proofFile.max'             => 'File must not exceed 10 MB.',
        'paymentReference.required' => 'Please enter the payment/transaction reference.',
    ];

    /**
     * Get the current village bank from session.
     */
    private function currentBank(): ?VillageBank
    {
        $bankId = session('current_village_bank_id');
        if (!$bankId) return null;
        return VillageBank::find($bankId);
    }

    /* ── Renewal actions ── */

    public function openRenewal()
    {
        $this->reset(['proofFile', 'paymentReference', 'selectedPlanId']);
        $this->resetErrorBag();

        // Default to current plan
        $bank = $this->currentBank();
        if ($bank) {
            $sub = $bank->activeSubscription;
            if ($sub) {
                $this->selectedPlanId = $sub->subscription_plan_id;
            }
        }

        $this->showRenewalModal = true;
    }

    public function submitRenewal()
    {
        $this->validate();

        $user = Auth::user();
        $bank = $this->currentBank();

        if (!$bank) {
            session()->flash('error', 'No village bank selected.');
            return;
        }

        // Find the existing subscription or create renewal reference
        $subscription = Subscription::where('village_bank_id', $bank->id)
            ->orderByDesc('created_at')
            ->first();

        if (!$subscription) {
            session()->flash('error', 'No subscription found. Please contact the administrator.');
            $this->showRenewalModal = false;
            return;
        }

        // If user picked a different plan (upgrade/downgrade), update subscription
        if ($this->selectedPlanId && $this->selectedPlanId != $subscription->subscription_plan_id) {
            $subscription->update(['subscription_plan_id' => $this->selectedPlanId]);
        }

        $plan = SubscriptionPlan::find($subscription->subscription_plan_id);
        $proofPath = $this->proofFile->store('payment_proofs', 'public');

        SubscriptionPayment::create([
            'subscription_id' => $subscription->id,
            'paid_by'         => $user->id,
            'amount'          => $plan ? $plan->price : 0,
            'reference'       => $this->paymentReference,
            'proof_file'      => $proofPath,
            'status'          => 'pending',
        ]);

        $this->showRenewalModal = false;
        $this->reset(['proofFile', 'paymentReference', 'selectedPlanId']);
        session()->flash('success', 'Renewal payment submitted successfully! The administrator will review and activate your license.');
    }

    public function render()
    {
        $bank = $this->currentBank();
        $license = null;
        $subscription = null;
        $plan = null;
        $usage = null;
        $payments = collect();
        $paymentMethods = collect();
        $availablePlans = collect();
        $features = [];

        if ($bank) {
            $license = License::where('village_bank_id', $bank->id)
                ->orderByDesc('issued_at')
                ->first();

            $subscription = Subscription::with('plan')
                ->where('village_bank_id', $bank->id)
                ->where('status', 'active')
                ->latest()
                ->first();

            if (!$subscription) {
                // Also check for the most recent expired/cancelled subscription
                $subscription = Subscription::with('plan')
                    ->where('village_bank_id', $bank->id)
                    ->orderByDesc('created_at')
                    ->first();
            }

            $plan = $subscription ? $subscription->plan : null;

            // Usage summary from LicenseEnforcement
            $enforcement = LicenseEnforcement::forBank($bank->id);
            $usage = $enforcement->usageSummary();

            // Recent payments
            if ($subscription) {
                $payments = SubscriptionPayment::where('subscription_id', $subscription->id)
                    ->orderByDesc('created_at')
                    ->limit(10)
                    ->get();
            }

            // Payment configuration (how to pay)
            $paymentMethods = PaymentConfiguration::active()->ordered()->get();

            // Available plans for upgrade/renewal
            $availablePlans = SubscriptionPlan::where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('price')
                ->get();

            // Build features list from plan
            if ($plan) {
                $features = $plan->features ?? [];
            }
        }

        return view('livewire.subscription.my-license', compact(
            'bank', 'license', 'subscription', 'plan', 'usage',
            'payments', 'paymentMethods', 'availablePlans', 'features'
        ));
    }
}
