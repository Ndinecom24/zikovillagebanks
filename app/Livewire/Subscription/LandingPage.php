<?php

namespace App\Livewire\Subscription;

use App\Mail\Subscription\ApplicationReceived;
use App\Mail\Subscription\NewApplicationAdminAlert;
use App\Models\Subscription\BankApplication;
use App\Models\Subscription\PaymentConfiguration;
use App\Models\Subscription\PromoCode;
use App\Models\Subscription\SubscriptionPlan;
use App\Models\Subscription\TrainingApplication;
use App\Models\Subscription\TrainingProgram;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('layouts.landing')]
class LandingPage extends Component
{
    use WithFileUploads;

    public $showApplyModal = false;
    public $selectedPlanId = '';

    /* ── Application form fields ──────── */
    public $bankName = '';
    public $bankDescription = '';
    public $bankAddress = '';
    public $bankPhone = '';
    public $bankEmail = '';
    public $contactName = '';
    public $contactEmail = '';
    public $contactPhone = '';
    public $proofFile;
    public $paymentReference = '';

    public $successMessage = '';

    /* ── Promo code fields ─────────────── */
    public $promoCodeInput = '';
    public $appliedPromoCode = null;   // PromoCode model (or null)
    public $promoDiscount = 0;         // calculated discount amount
    public $promoError = '';
    public $promoSuccess = '';

    /* ── Training application fields ───── */
    public $showTrainingModal = false;
    public $selectedTrainingId = null;
    public $trainingFullName = '';
    public $trainingEmail = '';
    public $trainingPhone = '';
    public $trainingVillageBank = '';
    public $trainingRoleInBank = '';
    public $trainingMotivation = '';

    public function selectPlan($planId)
    {
        $this->selectedPlanId = $planId;
        $this->showApplyModal = true;
        $this->clearPromoCode();
    }

    public function closeModal()
    {
        $this->showApplyModal = false;
        $this->resetForm();
    }

    /* ── Promo code actions ─────────────── */

    public function applyPromoCode()
    {
        $this->promoError = '';
        $this->promoSuccess = '';
        $this->appliedPromoCode = null;
        $this->promoDiscount = 0;

        $code = strtoupper(trim($this->promoCodeInput));
        if (empty($code)) {
            $this->promoError = 'Please enter a promo code.';
            return;
        }

        $promo = PromoCode::where('code', $code)->first();
        if (! $promo) {
            $this->promoError = 'Invalid promo code.';
            return;
        }

        if (! $promo->isValid()) {
            $this->promoError = 'This promo code is no longer valid or has expired.';
            return;
        }

        // Get the selected plan
        $plan = SubscriptionPlan::find($this->selectedPlanId);
        if (! $plan) {
            $this->promoError = 'Please select a plan first.';
            return;
        }

        // Check plan restriction
        if ($promo->plan_id && $promo->plan_id !== $plan->id) {
            $this->promoError = 'This code is not valid for the selected plan.';
            return;
        }

        // Minimum price check (against effective price after plan-level discount)
        if ((float) $plan->effectivePrice() < (float) $promo->min_plan_price) {
            $this->promoError = 'Plan must cost at least K' . number_format($promo->min_plan_price, 2) . ' to use this code.';
            return;
        }

        // Calculate discount
        $discount = $promo->calculateDiscount($plan);

        $this->appliedPromoCode = $promo;
        $this->promoDiscount = $discount;
        $this->promoSuccess = $promo->discountLabel() . ' applied! You save K' . number_format($discount, 2) . '.';
    }

    public function removePromoCode()
    {
        $this->clearPromoCode();
    }

    private function clearPromoCode()
    {
        $this->promoCodeInput = '';
        $this->appliedPromoCode = null;
        $this->promoDiscount = 0;
        $this->promoError = '';
        $this->promoSuccess = '';
    }

    /**
     * Get the final price after plan discount + promo code discount.
     */
    public function getFinalPrice(): float
    {
        $plan = SubscriptionPlan::find($this->selectedPlanId);
        if (! $plan) {
            return 0;
        }

        $effective = $plan->effectivePrice();

        return max(0, round($effective - $this->promoDiscount, 2));
    }

    /* ── Training modal actions ─────── */

    public function openTrainingModal($programId)
    {
        $this->selectedTrainingId = $programId;
        $this->showTrainingModal = true;
    }

    public function closeTrainingModal()
    {
        $this->showTrainingModal = false;
        $this->resetTrainingForm();
    }

    public function submitTrainingApplication()
    {
        $this->validate([
            'selectedTrainingId'  => 'required|exists:training_programs,id',
            'trainingFullName'    => 'required|string|max:255',
            'trainingEmail'       => 'required|email|max:255',
            'trainingPhone'       => 'required|string|max:20',
            'trainingVillageBank' => 'nullable|string|max:255',
            'trainingRoleInBank'  => 'nullable|string|max:100',
            'trainingMotivation'  => 'nullable|string|max:1000',
        ], [
            'trainingFullName.required' => 'Your full name is required.',
            'trainingEmail.required'    => 'Email address is required.',
            'trainingPhone.required'    => 'Phone number is required.',
        ]);

        // Check program is not full
        $program = TrainingProgram::findOrFail($this->selectedTrainingId);
        if ($program->isFull()) {
            session()->flash('error', 'Sorry, this program is already full.');
            $this->closeTrainingModal();
            return;
        }

        TrainingApplication::create([
            'training_program_id' => $this->selectedTrainingId,
            'full_name'           => $this->trainingFullName,
            'email'               => $this->trainingEmail,
            'phone'               => $this->trainingPhone,
            'village_bank'        => $this->trainingVillageBank ?: null,
            'role_in_bank'        => $this->trainingRoleInBank ?: null,
            'motivation'          => $this->trainingMotivation ?: null,
            'status'              => 'pending',
        ]);

        $this->showTrainingModal = false;
        $this->resetTrainingForm();
        $this->successMessage = 'Training application submitted! We will review and get back to you via email.';
    }

    private function resetTrainingForm()
    {
        $this->reset([
            'trainingFullName', 'trainingEmail', 'trainingPhone',
            'trainingVillageBank', 'trainingRoleInBank', 'trainingMotivation',
            'selectedTrainingId',
        ]);
        $this->resetErrorBag();
    }

    public function submitApplication()
    {
        $this->validate([
            'selectedPlanId'   => 'required|exists:subscription_plans,id',
            'bankName'         => 'required|string|max:255',
            'bankPhone'        => 'required|string|max:20',
            'bankEmail'        => 'required|email|max:255',
            'contactName'      => 'required|string|max:255',
            'contactEmail'     => 'required|email|max:255',
            'contactPhone'     => 'required|string|max:20',
            'proofFile'        => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'paymentReference' => 'required|string|max:100',
        ], [
            'selectedPlanId.required'   => 'Select a subscription plan.',
            'bankName.required'         => 'Village bank name is required.',
            'bankPhone.required'        => 'Phone number is required.',
            'bankEmail.required'        => 'Email address is required.',
            'contactName.required'      => 'Contact person name is required.',
            'contactEmail.required'     => 'Contact email is required.',
            'contactPhone.required'     => 'Contact phone is required.',
            'proofFile.required'        => 'Upload proof of payment.',
            'proofFile.max'             => 'File must not exceed 10 MB.',
            'paymentReference.required' => 'Payment reference is required.',
        ]);

        $proofPath = $this->proofFile->store('application_proofs', 'public');

        // Auto-generate bank code: VB-XXXXXX (unique)
        $bankCode = $this->generateUniqueBankCode();

        // Auto-generate member number: MBR-XXXXXXXX (unique)
        $memberNumber = $this->generateUniqueMemberNumber();

        $applicationData = [
            'bank_name'            => $this->bankName,
            'bank_code'            => $bankCode,
            'bank_description'     => $this->bankDescription ?: null,
            'bank_address'         => $this->bankAddress ?: null,
            'bank_phone'           => $this->bankPhone,
            'bank_email'           => $this->bankEmail,
            'contact_name'         => $this->contactName,
            'contact_email'        => $this->contactEmail,
            'contact_phone'        => $this->contactPhone,
            'contact_staff_no'     => $memberNumber,
            'subscription_plan_id' => $this->selectedPlanId,
            'proof_file'           => $proofPath,
            'payment_reference'    => $this->paymentReference,
            'status'               => 'pending',
        ];

        // Attach promo code info if one was applied
        if ($this->appliedPromoCode) {
            $applicationData['promo_code_id']    = $this->appliedPromoCode->id;
            $applicationData['promo_discount']   = $this->promoDiscount;
            $applicationData['amount_due']       = $this->getFinalPrice();
        } else {
            $plan = SubscriptionPlan::find($this->selectedPlanId);
            $applicationData['amount_due']       = $plan ? $plan->effectivePrice() : 0;
        }

        $application = BankApplication::create($applicationData);

        // Send confirmation email to applicant
        try {
            Mail::to($this->contactEmail)
                ->send(new ApplicationReceived($application));
        } catch (\Exception $e) {
            \Log::warning('Failed to send application received email: ' . $e->getMessage());
        }

        // Send notification email to all super admins
        try {
            $adminEmails = User::where('user_role_id', 1)
                ->whereNotNull('email')
                ->pluck('email')
                ->toArray();

            if (!empty($adminEmails)) {
                Mail::to($adminEmails)
                    ->send(new NewApplicationAdminAlert($application));
            }
        } catch (\Exception $e) {
            \Log::warning('Failed to send admin alert email: ' . $e->getMessage());
        }

        $this->showApplyModal = false;
        $this->resetForm();
        $this->successMessage = 'Application submitted successfully! We will review your payment and get back to you via email.';
    }

    private function resetForm()
    {
        $this->reset([
            'bankName', 'bankDescription', 'bankAddress',
            'bankPhone', 'bankEmail', 'contactName', 'contactEmail',
            'contactPhone', 'proofFile', 'paymentReference',
            'selectedPlanId',
        ]);
        $this->clearPromoCode();
        $this->resetErrorBag();
    }

    /**
     * Generate a unique village bank code (e.g. VB-A3X9K2).
     */
    private function generateUniqueBankCode(): string
    {
        do {
            $code = 'VB-' . Str::upper(Str::random(6));
        } while (BankApplication::where('bank_code', $code)->exists());

        return $code;
    }

    /**
     * Generate a unique member number (e.g. MBR-00000012).
     */
    private function generateUniqueMemberNumber(): string
    {
        $lastApp = BankApplication::whereNotNull('contact_staff_no')
            ->where('contact_staff_no', 'like', 'MBR-%')
            ->orderByDesc('id')
            ->first();

        $nextNum = 1;
        if ($lastApp && preg_match('/MBR-(\d+)/', $lastApp->contact_staff_no, $m)) {
            $nextNum = (int) $m[1] + 1;
        }

        return 'MBR-' . str_pad($nextNum, 8, '0', STR_PAD_LEFT);
    }

    public function render()
    {
        $plans = SubscriptionPlan::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('price')
            ->get();

        $paymentMethods = PaymentConfiguration::active()->ordered()->get();

        $trainingPrograms = TrainingProgram::published()->ordered()->get();

        return view('livewire.subscription.landing-page', compact('plans', 'paymentMethods', 'trainingPrograms'));
    }
}
