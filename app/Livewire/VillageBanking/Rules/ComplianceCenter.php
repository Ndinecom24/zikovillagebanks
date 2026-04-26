<?php

namespace App\Livewire\VillageBanking\Rules;

use App\Models\VillageBanking\Constitution;
use App\Models\VillageBanking\ConstitutionAcknowledgement;
use App\Models\VillageBanking\Rule;
use App\Models\VillageBanking\RuleAcknowledgement;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankConfiguration;
use App\Models\VillageBanking\VillageBankMember;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class ComplianceCenter extends Component
{
    use HasVillageBankScope;

    public $showConstitutionModal = false;

    /* ── Acknowledge a single rule ─────── */

    public function acknowledgeRule($ruleId)
    {
        $rule = Rule::findOrFail($ruleId);

        RuleAcknowledgement::firstOrCreate(
            ['rule_id' => $ruleId, 'user_id' => Auth::id()],
            ['acknowledged_at' => now()]
        );

        // Update the pivot quick-lookup flag
        $this->updateRulesFlag();

        session()->flash('message', 'Rule "' . $rule->title . '" acknowledged.');
    }

    /* ── Acknowledge all rules at once ─── */

    public function acknowledgeAllRules()
    {
        $bankId = $this->activeBankId();
        if (empty($bankId)) return;

        $rules = Rule::where('village_bank_id', $bankId)->where('is_active', true)->get();

        foreach ($rules as $rule) {
            RuleAcknowledgement::firstOrCreate(
                ['rule_id' => $rule->id, 'user_id' => Auth::id()],
                ['acknowledged_at' => now()]
            );
        }

        $this->updateRulesFlag();
        session()->flash('message', 'All rules acknowledged successfully.');
    }

    /* ── Open constitution viewer ─────── */

    public function viewConstitution()
    {
        $this->showConstitutionModal = true;
    }

    public function closeConstitution()
    {
        $this->showConstitutionModal = false;
    }

    /* ── Sign/acknowledge the constitution ─ */

    public function acknowledgeConstitution()
    {
        $bankId = $this->activeBankId();
        if (empty($bankId)) return;

        $constitution = Constitution::where('village_bank_id', $bankId)->first();
        if (! $constitution) return;

        ConstitutionAcknowledgement::updateOrCreate(
            ['constitution_id' => $constitution->id, 'user_id' => Auth::id()],
            [
                'version_acknowledged' => $constitution->version,
                'ip_address'           => request()->ip(),
                'acknowledged_at'      => now(),
            ]
        );

        // Update the pivot quick-lookup flag
        $membership = VillageBankMember::where('village_bank_id', $bankId)
            ->where('user_id', Auth::id())
            ->first();

        if ($membership) {
            $membership->update([
                'constitution_acknowledged'    => true,
                'constitution_acknowledged_at' => now(),
            ]);
        }

        $this->showConstitutionModal = false;
        session()->flash('message', 'Constitution signed successfully. Thank you!');
    }

    /* ── Helper: update rules_acknowledged flag on pivot ── */

    protected function updateRulesFlag()
    {
        $bankId = $this->activeBankId();
        if (empty($bankId)) return;

        $activeRuleIds = Rule::where('village_bank_id', $bankId)
            ->where('is_active', true)
            ->pluck('id');

        $ackedCount = RuleAcknowledgement::where('user_id', Auth::id())
            ->whereIn('rule_id', $activeRuleIds)
            ->count();

        $allAcked = $ackedCount >= $activeRuleIds->count();

        VillageBankMember::where('village_bank_id', $bankId)
            ->where('user_id', Auth::id())
            ->update([
                'rules_acknowledged'    => $allAcked,
                'rules_acknowledged_at' => $allAcked ? now() : null,
            ]);
    }

    /* ── Render ────────────────────────── */

    public function render()
    {
        $bankId = $this->activeBankId();
        $userId = Auth::id();

        $config = null;
        $rules  = collect();
        $constitution = null;
        $membership = null;
        $rulesProgress    = 0;
        $allRulesAcked    = false;
        $constitutionAcked = false;
        $isCompliant      = false;

        if (! empty($bankId)) {
            $bank   = VillageBank::find($bankId);
            $config = $bank ? ($bank->configuration ?? VillageBankConfiguration::forBank($bankId)) : null;

            // Rules
            $rules = Rule::where('village_bank_id', $bankId)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->map(function ($rule) use ($userId) {
                    $rule->is_acknowledged = $rule->isAcknowledgedBy($userId);
                    return $rule;
                });

            $ackedRules = $rules->where('is_acknowledged', true)->count();
            $rulesProgress = $rules->count() > 0
                ? round(($ackedRules / $rules->count()) * 100, 0)
                : 100;
            $allRulesAcked = $ackedRules >= $rules->count();

            // Constitution
            $constitution = Constitution::where('village_bank_id', $bankId)->first();
            if ($constitution) {
                $constitutionAcked = $constitution->isAcknowledgedBy($userId);
            }

            // Membership
            $membership = VillageBankMember::where('village_bank_id', $bankId)
                ->where('user_id', $userId)
                ->first();

            $isCompliant = $membership ? $membership->isCompliant() : false;
        }

        return view('livewire.village-banking.rules.compliance-center', compact(
            'config', 'rules', 'constitution', 'membership',
            'rulesProgress', 'allRulesAcked', 'constitutionAcked', 'isCompliant',
        ));
    }
}
