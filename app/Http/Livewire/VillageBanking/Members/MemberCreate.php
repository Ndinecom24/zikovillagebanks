<?php

namespace App\Http\Livewire\VillageBanking\Members;

use App\Models\User;
use App\Services\LicenseEnforcement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class MemberCreate extends Component
{
    // ── Personal Information ──
    public $name = '';
    public $email = '';
    public $phone = '';
    public $mobileNo = '';
    public $dateOfBirth = '';
    public $gender = '';
    public $nationalId = '';
    public $password = '';
    public $passwordConfirmation = '';

    // ── Employment ──
    public $employmentStatus = '';
    public $jobTitle = '';
    public $companyName = '';
    public $companyLocation = '';

    // ── Address ──
    public $country = 'Zambia';
    public $province = '';
    public $city = '';
    public $homeAddress = '';

    // ── Next of Kin ──
    public $nokName = '';
    public $nokRelationship = '';
    public $nokContact = '';
    public $nokAddress = '';

    // ── Guarantor ──
    public $guarantorSearch = '';
    public $guarantorId = null;
    public $guarantorName = '';
    public $showGuarantorResults = false;

    // ── UI State ──
    public $currentStep = 1;
    public $totalSteps = 4;
    public $successMessage = '';
    public $memberLimitReached = false;
    public $memberLimitMessage = '';

    public function mount()
    {
        $this->checkMemberLimit();
    }

    protected function checkMemberLimit()
    {
        $bankId = session('current_village_bank_id');
        if ($bankId) {
            $check = LicenseEnforcement::forBank($bankId)->canAddMembers();
            $this->memberLimitReached = !$check['allowed'];
            $this->memberLimitMessage = $check['message'];
        }
    }

    protected function rules()
    {
        return [
            // Step 1 – Personal Info
            'name'                  => 'required|string|max:255',
            'email'                 => ['required', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'phone'                 => 'required|string|max:20',
            'mobileNo'              => 'nullable|string|max:20',
            'dateOfBirth'           => 'nullable|date|before:today',
            'gender'                => 'nullable|in:male,female,other',
            'nationalId'            => 'nullable|string|max:50',
            'password'              => 'required|string|min:8',
            'passwordConfirmation'  => 'required|same:password',
            // Step 2 – Employment
            'employmentStatus'      => 'nullable|in:employed,self_employed,unemployed,student,retired',
            'jobTitle'              => 'nullable|string|max:255',
            'companyName'           => 'nullable|string|max:255',
            'companyLocation'       => 'nullable|string|max:255',
            // Step 3 – Address & Next of Kin
            'country'               => 'nullable|string|max:100',
            'province'              => 'nullable|string|max:100',
            'city'                  => 'nullable|string|max:100',
            'homeAddress'           => 'nullable|string|max:500',
            'nokName'               => 'nullable|string|max:255',
            'nokRelationship'       => 'nullable|string|max:100',
            'nokContact'            => 'nullable|string|max:50',
            'nokAddress'            => 'nullable|string|max:500',
            // Step 4 – Guarantor
            'guarantorId'           => 'required|exists:users,id',
        ];
    }

    protected $messages = [
        'name.required'              => 'Full name is required.',
        'email.required'             => 'Email address is required.',
        'email.unique'               => 'This email is already registered.',
        'phone.required'             => 'Phone number is required.',
        'password.required'          => 'Password is required.',
        'password.min'               => 'Password must be at least 8 characters.',
        'passwordConfirmation.same'  => 'Passwords do not match.',
        'dateOfBirth.before'         => 'Date of birth must be in the past.',
        'guarantorId.required'       => 'A guarantor must be selected.',
        'guarantorId.exists'         => 'Selected guarantor is invalid.',
    ];

    /* ── Step navigation ────────────────── */

    public function nextStep()
    {
        // Validate current step before advancing
        $this->validateCurrentStep();
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function goToStep($step)
    {
        // Only allow going back or to current step without validation
        if ($step <= $this->currentStep) {
            $this->currentStep = $step;
        }
    }

    private function validateCurrentStep()
    {
        switch ($this->currentStep) {
            case 1:
                $this->validate([
                    'name'     => 'required|string|max:255',
                    'email'    => ['required', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')],
                    'phone'    => 'required|string|max:20',
                    'password' => 'required|string|min:8',
                    'passwordConfirmation' => 'required|same:password',
                ]);
                break;
            case 2:
                $this->validate([
                    'employmentStatus' => 'nullable|in:employed,self_employed,unemployed,student,retired',
                    'jobTitle'         => 'nullable|string|max:255',
                    'companyName'      => 'nullable|string|max:255',
                    'companyLocation'  => 'nullable|string|max:255',
                ]);
                break;
            case 3:
                $this->validate([
                    'country'     => 'nullable|string|max:100',
                    'province'    => 'nullable|string|max:100',
                    'city'        => 'nullable|string|max:100',
                    'homeAddress' => 'nullable|string|max:500',
                    'nokName'     => 'nullable|string|max:255',
                    'nokContact'  => 'nullable|string|max:50',
                ]);
                break;
        }
    }

    /* ── Guarantor search ────────────────── */

    public function updatedGuarantorSearch()
    {
        $this->showGuarantorResults = strlen($this->guarantorSearch) >= 2;
    }

    public function selectGuarantor($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->guarantorId = $user->id;
            $this->guarantorName = $user->name;
            $this->guarantorSearch = '';
            $this->showGuarantorResults = false;
        }
    }

    public function clearGuarantor()
    {
        $this->guarantorId = null;
        $this->guarantorName = '';
        $this->guarantorSearch = '';
    }

    public function getGuarantorResultsProperty()
    {
        if (strlen($this->guarantorSearch) < 2) {
            return collect();
        }

        $term = '%' . trim($this->guarantorSearch) . '%';

        return User::where('status', 'active')
            ->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('email', 'like', $term)
                  ->orWhere('phone', 'like', $term);
            })
            ->limit(10)
            ->get(['id', 'name', 'email', 'phone']);
    }

    /* ── Register member ─────────────────── */

    public function register()
    {
        // Enforce member limit before creating a new member
        $bankId = session('current_village_bank_id');
        if ($bankId) {
            $check = LicenseEnforcement::forBank($bankId)->canAddMembers();
            if (!$check['allowed']) {
                $this->memberLimitReached = true;
                $this->memberLimitMessage = $check['message'];
                session()->flash('error', $check['message']);
                return;
            }
        }

        $this->validate();

        try {
            User::create([
                // Personal
                'name'               => $this->name,
                'email'              => $this->email,
                'phone'              => $this->phone,
                'mobile_no'          => $this->mobileNo ?: null,
                'date_of_birth'      => $this->dateOfBirth ?: null,
                'gender'             => $this->gender ?: null,
                'national_id'        => $this->nationalId ?: null,
                'password'           => Hash::make($this->password),
                // Employment
                'employment_status'  => $this->employmentStatus ?: null,
                'job_title'          => $this->jobTitle ?: null,
                'company_name'       => $this->companyName ?: null,
                'company_location'   => $this->companyLocation ?: null,
                // Address
                'country'            => $this->country ?: null,
                'province'           => $this->province ?: null,
                'city'               => $this->city ?: null,
                'home_address'       => $this->homeAddress ?: null,
                // Next of Kin
                'nok_name'           => $this->nokName ?: null,
                'nok_relationship'   => $this->nokRelationship ?: null,
                'nok_contact'        => $this->nokContact ?: null,
                'nok_address'        => $this->nokAddress ?: null,
                // Guarantor & System
                'guarantor_id'       => $this->guarantorId,
                'status'             => 'pending',
                'username'           => null,
                'user_role_id'       => '0',
                'password_changed'   => config('constants.password_not_changed', 0),
                'total_login'        => 0,
                'uuid'               => Str::uuid()->toString(),
            ]);

            $this->resetForm();
            $this->successMessage = 'Member registered successfully! Awaiting approval.';
        } catch (\Exception $e) {
            $this->addError('email', 'Failed to register member. Please try again.');
        }
    }

    public function resetForm()
    {
        $this->reset([
            'name', 'email', 'phone', 'mobileNo', 'dateOfBirth', 'gender', 'nationalId',
            'password', 'passwordConfirmation',
            'employmentStatus', 'jobTitle', 'companyName', 'companyLocation',
            'country', 'province', 'city', 'homeAddress',
            'nokName', 'nokRelationship', 'nokContact', 'nokAddress',
            'guarantorId', 'guarantorName', 'guarantorSearch',
            'currentStep',
        ]);
        $this->country = 'Zambia';
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.village-banking.members.member-create', [
            'guarantorResults' => $this->guarantorResults,
        ])->layout('layouts.main.master-livewire');
    }
}
