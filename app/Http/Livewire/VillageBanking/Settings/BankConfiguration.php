<?php

namespace App\Http\Livewire\VillageBanking\Settings;

use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankAccount;
use App\Models\VillageBanking\VillageBankConfiguration;
use App\Models\VillageBanking\VillageBankMonthConfig;
use App\Traits\HasVillageBankScope;
use Livewire\Component;

class BankConfiguration extends Component
{
    use HasVillageBankScope;

    /* ── Tab ──────────────────────────── */
    public $activeTab = 'general';

    /* ── Insurance ────────────────────── */
    public $insurance_type            = 'percentage';
    public $insurance_value           = 0;
    public $insurance_profit_to_members = true;

    /* ── Circle ───────────────────────── */
    public $circle_duration_months    = 12;

    /* ── Shares ───────────────────────── */
    public $share_unit_amount         = 200;
    public $min_shares_per_month      = 1;
    public $max_shares_per_month      = 50;

    /* ── Loans ────────────────────────── */
    public $max_loan_multiplier       = 3;
    public $default_interest_rate     = 20;
    public $interest_type             = 'flat';
    public $reducing_balance_rate     = 0;
    public $default_loan_duration     = 1;
    public $allow_multiple_active_loans = false;
    public $min_loan_amount           = '';
    public $max_loan_amount           = '';

    /* ── Penalties ────────────────────── */
    public $late_repayment_penalty_rate = 5;
    public $grace_period_days          = 0;

    /* ── Month configs ────────────────── */
    public $monthConfigs = [];

    /* ── Bank accounts ────────────────── */
    public $accounts = [];
    public $showAccountModal = false;
    public $editAccountIndex = null;
    public $accountForm = [
        'account_type'   => 'mobile_money',
        'provider_name'  => '',
        'account_name'   => '',
        'account_number' => '',
        'branch'         => '',
        'is_active'      => true,
        'is_primary'     => false,
    ];

    /* ── UI state ─────────────────────── */
    public $savedMessage = '';
    public $bankName     = '';
    public $bankCode     = '';

    /* ── Lifecycle ────────────────────── */

    public function mount()
    {
        $this->loadConfiguration();
    }

    public function updatedVillageBankId()
    {
        $this->loadConfiguration();
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->savedMessage = '';
    }

    protected function loadConfiguration()
    {
        $bankId = $this->activeBankId();
        if (empty($bankId)) {
            $this->bankName = '';
            $this->bankCode = '';
            return;
        }

        $bank = VillageBank::find($bankId);
        if (!$bank) return;

        $this->bankName = $bank->name;
        $this->bankCode = $bank->code;

        $config = VillageBankConfiguration::forBank($bankId);

        $this->circle_duration_months      = $config->circle_duration_months;
        $this->share_unit_amount             = $config->share_unit_amount;
        $this->min_shares_per_month          = $config->min_shares_per_month;
        $this->max_shares_per_month          = $config->max_shares_per_month;
        $this->insurance_type              = $config->insurance_type;
        $this->insurance_value             = $config->insurance_value;
        $this->insurance_profit_to_members = (bool) $config->insurance_profit_to_members;
        $this->max_loan_multiplier         = $config->max_loan_multiplier;
        $this->default_interest_rate       = $config->default_interest_rate;
        $this->interest_type               = $config->interest_type;
        $this->reducing_balance_rate       = $config->reducing_balance_rate;
        $this->default_loan_duration       = $config->default_loan_duration;
        $this->allow_multiple_active_loans = $config->allow_multiple_active_loans;
        $this->min_loan_amount             = $config->min_loan_amount ?? '';
        $this->max_loan_amount             = $config->max_loan_amount ?? '';
        $this->late_repayment_penalty_rate = $config->late_repayment_penalty_rate;
        $this->grace_period_days           = $config->grace_period_days;

        $this->loadMonthConfigs();
        $this->loadAccounts();
    }

    /* ═══════════════════════════════════════════
     *  MONTH CONFIGS
     * ═══════════════════════════════════════════ */

    protected function loadMonthConfigs()
    {
        $bankId = $this->activeBankId();
        $configs = VillageBankMonthConfig::where('village_bank_id', $bankId)
            ->orderBy('month_number')
            ->get();

        if ($configs->isEmpty()) {
            VillageBankMonthConfig::generateDefaults($bankId, $this->circle_duration_months);
            $configs = VillageBankMonthConfig::where('village_bank_id', $bankId)
                ->orderBy('month_number')
                ->get();
        }

        $this->monthConfigs = $configs->map(fn ($c) => [
            'id'                           => $c->id,
            'month_number'                 => $c->month_number,
            'label'                        => $c->label,
            'allow_share_declarations'     => $c->allow_share_declarations,
            'allow_insurance_declarations' => $c->allow_insurance_declarations,
            'allow_loan_requests'          => $c->allow_loan_requests,
            'allow_loan_repayments'        => $c->allow_loan_repayments,
            'is_shareout_month'            => $c->is_shareout_month,
        ])->toArray();
    }

    public function regenerateMonthConfigs()
    {
        $bankId = $this->activeBankId();
        if (empty($bankId)) return;

        $duration = max(1, (int) $this->circle_duration_months);
        VillageBankMonthConfig::generateDefaults($bankId, $duration);
        $this->loadMonthConfigs();
        $this->savedMessage = 'Month configurations regenerated with defaults.';
    }

    public function saveMonthConfigs()
    {
        $bankId = $this->activeBankId();
        if (empty($bankId)) return;

        foreach ($this->monthConfigs as $mc) {
            VillageBankMonthConfig::where('id', $mc['id'])->update([
                'label'                        => $mc['label'],
                'allow_share_declarations'     => (bool) $mc['allow_share_declarations'],
                'allow_insurance_declarations' => (bool) $mc['allow_insurance_declarations'],
                'allow_loan_requests'          => (bool) $mc['allow_loan_requests'],
                'allow_loan_repayments'        => (bool) $mc['allow_loan_repayments'],
                'is_shareout_month'            => (bool) $mc['is_shareout_month'],
            ]);
        }

        $this->savedMessage = 'Month configurations saved successfully.';
    }

    /* ═══════════════════════════════════════════
     *  BANK ACCOUNTS
     * ═══════════════════════════════════════════ */

    protected function loadAccounts()
    {
        $bankId = $this->activeBankId();
        $this->accounts = VillageBankAccount::where('village_bank_id', $bankId)
            ->orderBy('sort_order')
            ->get()
            ->toArray();
    }

    public function openAccountModal($index = null)
    {
        $this->resetAccountForm();
        if ($index !== null && isset($this->accounts[$index])) {
            $acct = $this->accounts[$index];
            $this->editAccountIndex = $index;
            $this->accountForm = [
                'account_type'   => $acct['account_type'],
                'provider_name'  => $acct['provider_name'],
                'account_name'   => $acct['account_name'],
                'account_number' => $acct['account_number'],
                'branch'         => $acct['branch'] ?? '',
                'is_active'      => (bool) $acct['is_active'],
                'is_primary'     => (bool) $acct['is_primary'],
            ];
        }
        $this->showAccountModal = true;
    }

    public function resetAccountForm()
    {
        $this->editAccountIndex = null;
        $this->accountForm = [
            'account_type'   => 'mobile_money',
            'provider_name'  => '',
            'account_name'   => '',
            'account_number' => '',
            'branch'         => '',
            'is_active'      => true,
            'is_primary'     => false,
        ];
        $this->resetErrorBag();
    }

    public function saveAccount()
    {
        $this->validate([
            'accountForm.provider_name'  => 'required|string|max:100',
            'accountForm.account_name'   => 'required|string|max:150',
            'accountForm.account_number' => 'required|string|max:80',
            'accountForm.account_type'   => 'required|in:bank_account,mobile_money',
            'accountForm.branch'         => 'nullable|string|max:100',
        ], [
            'accountForm.provider_name.required'  => 'Provider name is required.',
            'accountForm.account_name.required'   => 'Account name is required.',
            'accountForm.account_number.required' => 'Account number is required.',
        ]);

        $bankId = $this->activeBankId();

        if ($this->accountForm['is_primary']) {
            VillageBankAccount::where('village_bank_id', $bankId)->update(['is_primary' => false]);
        }

        $data = array_merge($this->accountForm, ['village_bank_id' => $bankId]);

        if ($this->editAccountIndex !== null && isset($this->accounts[$this->editAccountIndex])) {
            VillageBankAccount::where('id', $this->accounts[$this->editAccountIndex]['id'])->update($data);
            $this->savedMessage = 'Account updated.';
        } else {
            $data['sort_order'] = count($this->accounts);
            VillageBankAccount::create($data);
            $this->savedMessage = 'Account added.';
        }

        $this->showAccountModal = false;
        $this->loadAccounts();
    }

    public function deleteAccount($index)
    {
        if (isset($this->accounts[$index])) {
            VillageBankAccount::where('id', $this->accounts[$index]['id'])->delete();
            $this->loadAccounts();
            $this->savedMessage = 'Account removed.';
        }
    }

    public function toggleAccountActive($index)
    {
        if (isset($this->accounts[$index])) {
            $acct = VillageBankAccount::find($this->accounts[$index]['id']);
            if ($acct) {
                $acct->update(['is_active' => !$acct->is_active]);
                $this->loadAccounts();
            }
        }
    }

    /* ═══════════════════════════════════════════
     *  GENERAL CONFIG SAVE
     * ═══════════════════════════════════════════ */

    protected function rules()
    {
        return [
            'circle_duration_months'      => 'required|integer|min:1|max:60',
            'share_unit_amount'           => 'required|numeric|min:1',
            'min_shares_per_month'        => 'required|integer|min:1|max:1000',
            'max_shares_per_month'        => 'required|integer|min:1|max:1000',
            'insurance_type'              => 'required|in:percentage,fixed',
            'insurance_value'             => 'required|numeric|min:0',
            'insurance_profit_to_members' => 'boolean',
            'max_loan_multiplier'         => 'required|integer|min:1|max:20',
            'default_interest_rate'       => 'required|numeric|min:0|max:100',
            'interest_type'               => 'required|in:flat,reducing_balance',
            'reducing_balance_rate'       => 'nullable|numeric|min:0|max:100',
            'default_loan_duration'       => 'required|integer|min:1|max:12',
            'allow_multiple_active_loans' => 'boolean',
            'min_loan_amount'             => 'nullable|numeric|min:0',
            'max_loan_amount'             => 'nullable|numeric|min:0',
            'late_repayment_penalty_rate' => 'required|numeric|min:0|max:100',
            'grace_period_days'           => 'required|integer|min:0|max:90',
        ];
    }

    protected $messages = [
        'max_loan_multiplier.min' => 'The multiplier must be at least 1.',
        'max_loan_multiplier.max' => 'The multiplier cannot exceed 20.',
    ];

    public function saveConfiguration()
    {
        $bankId = $this->activeBankId();
        if (empty($bankId)) {
            session()->flash('warning', 'Please select a village bank first.');
            return;
        }

        $this->validate();

        VillageBankConfiguration::updateOrCreate(
            ['village_bank_id' => $bankId],
            [
                'circle_duration_months'      => (int) $this->circle_duration_months,
                'share_unit_amount'           => (float) $this->share_unit_amount,
                'min_shares_per_month'        => (int) $this->min_shares_per_month,
                'max_shares_per_month'        => (int) $this->max_shares_per_month,
                'insurance_type'              => $this->insurance_type,
                'insurance_value'             => (float) $this->insurance_value,
                'insurance_profit_to_members' => (bool) $this->insurance_profit_to_members,
                'max_loan_multiplier'         => (int) $this->max_loan_multiplier,
                'default_interest_rate'       => (float) $this->default_interest_rate,
                'interest_type'               => $this->interest_type,
                'reducing_balance_rate'       => $this->interest_type === 'reducing_balance' ? (float) $this->reducing_balance_rate : 0,
                'default_loan_duration'       => (int) $this->default_loan_duration,
                'allow_multiple_active_loans' => (bool) $this->allow_multiple_active_loans,
                'min_loan_amount'             => $this->min_loan_amount !== '' ? (float) $this->min_loan_amount : null,
                'max_loan_amount'             => $this->max_loan_amount !== '' ? (float) $this->max_loan_amount : null,
                'late_repayment_penalty_rate' => (float) $this->late_repayment_penalty_rate,
                'grace_period_days'           => (int) $this->grace_period_days,
            ]
        );

        $this->savedMessage = 'Configuration saved successfully.';
    }

    /* ── Computed ──────────────────────── */

    public function getExampleBorrowableProperty()
    {
        $exampleSavings = 10000;
        return $exampleSavings * max(1, (int) $this->max_loan_multiplier);
    }

    /* ── Render ────────────────────────── */

    public function render()
    {
        return view('livewire.village-banking.settings.bank-configuration')
            ->layout('layouts.main.master-livewire');
    }
}
