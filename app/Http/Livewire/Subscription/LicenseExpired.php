<?php

namespace App\Http\Livewire\Subscription;

use App\Models\Subscription\License;
use App\Models\Subscription\Subscription;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class LicenseExpired extends Component
{
    use WithFileUploads;

    public $showRenewalModal = false;
    public $proofFile;
    public $paymentReference = '';
    public $successMessage = '';

    public function openRenewal()
    {
        $this->showRenewalModal = true;
    }

    public function submitRenewal()
    {
        $this->validate([
            'proofFile'        => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'paymentReference' => 'required|string|max:100',
        ]);

        $user = Auth::user();
        $villageBankId = session('current_village_bank_id');

        // Find the most recent subscription
        $subscription = Subscription::where('village_bank_id', $villageBankId)
            ->orderByDesc('created_at')
            ->first();

        if (!$subscription) {
            session()->flash('error', 'No subscription found. Please contact the administrator.');
            return;
        }

        $proofPath = $this->proofFile->store('payment_proofs', 'public');

        \App\Models\Subscription\SubscriptionPayment::create([
            'subscription_id'  => $subscription->id,
            'paid_by'          => $user->id,
            'amount'           => $subscription->plan ? $subscription->plan->price : 0,
            'reference'        => $this->paymentReference,
            'proof_file'       => $proofPath,
            'status'           => 'pending',
        ]);

        $this->showRenewalModal = false;
        $this->reset(['proofFile', 'paymentReference']);
        $this->successMessage = 'Renewal payment submitted! The admin will review your payment and reactivate your license.';
    }

    public function render()
    {
        return view('livewire.subscription.license-expired')
            ->layout('layouts.auth');
    }
}
