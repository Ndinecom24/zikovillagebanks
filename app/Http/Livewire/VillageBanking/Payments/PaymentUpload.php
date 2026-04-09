<?php

namespace App\Http\Livewire\VillageBanking\Payments;

use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\PaymentMethod;
use App\Models\VillageBanking\Transaction;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaymentUpload extends Component
{
    use WithFileUploads, HasVillageBankScope;

    public $circleId = '';
    public $monthId = '';
    public $receiverId = '';
    public $amount = '';
    public $paymentMethodId = '';
    public $loanId = '';
    public $proofFile;

    public $successMessage = '';

    protected function rules()
    {
        return [
            'circleId'        => 'required|exists:circles,id',
            'monthId'         => 'required|exists:months,id',
            'receiverId'      => 'required|exists:users,id',
            'amount'          => 'required|numeric|min:0.01',
            'paymentMethodId' => 'required|exists:payment_methods,id',
            'proofFile'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ];
    }

    protected $messages = [
        'circleId.required'        => 'Select a circle.',
        'monthId.required'         => 'Select a month.',
        'receiverId.required'      => 'Select a receiver.',
        'amount.required'          => 'Amount is required.',
        'amount.min'               => 'Amount must be greater than zero.',
        'paymentMethodId.required' => 'Select a payment method.',
        'proofFile.max'            => 'File must not exceed 5 MB.',
    ];

    public function updatedCircleId()
    {
        $this->monthId = '';
        $this->receiverId = '';
    }

    public function submitPayment()
    {
        $this->validate();

        $proofPath = null;
        if ($this->proofFile) {
            $proofPath = $this->proofFile->store('payment_proofs', 'public');
        }

        Transaction::create([
            'sender_id'         => Auth::id(),
            'receiver_id'       => $this->receiverId,
            'loan_id'           => !empty($this->loanId) ? $this->loanId : null,
            'month_id'          => $this->monthId,
            'amount'            => (float) $this->amount,
            'payment_method_id' => $this->paymentMethodId,
            'proof_file'        => $proofPath,
            'status'            => 'pending',
        ]);

        $this->reset(['circleId', 'monthId', 'receiverId', 'amount', 'paymentMethodId', 'loanId', 'proofFile']);
        $this->resetErrorBag();
        $this->successMessage = 'Payment uploaded successfully. Awaiting confirmation.';
    }

    /* ── Computed ───────────────────────── */

    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()
            ->where('status', 'active')
            ->withCount('members')
            ->orderBy('name')
            ->get();
    }

    public function getMonthsProperty()
    {
        if (empty($this->circleId)) return collect();
        return Month::where('circle_id', $this->circleId)->where('status', 'active')->orderBy('month_number')->get();
    }

    public function getMembersProperty()
    {
        if (empty($this->circleId)) return collect();
        return Circle::findOrFail($this->circleId)
            ->members()
            ->where('users.id', '!=', Auth::id())
            ->where('status', 'active')
            ->orderBy('name')
            ->get();
    }

    public function getPaymentMethodsProperty()
    {
        return PaymentMethod::where('is_active', true)->orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.village-banking.payments.payment-upload', [
            'circles'        => $this->circles,
            'months'         => $this->months,
            'membersList'    => $this->members,
            'paymentMethods' => $this->paymentMethods,
        ])->layout('layouts.main.master-livewire');
    }
}
