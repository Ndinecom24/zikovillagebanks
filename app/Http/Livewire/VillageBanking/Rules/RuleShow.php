<?php

namespace App\Http\Livewire\VillageBanking\Rules;

use App\Models\VillageBanking\Rule;
use App\Models\VillageBanking\RuleAcknowledgement;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RuleShow extends Component
{
    public Rule $rule;

    public function mount($ruleId)
    {
        $this->rule = Rule::with([
            'creator',
            'villageBank',
            'acknowledgements.user',
        ])->findOrFail($ruleId);
    }

    /* ── Computed ──────────── */

    public function getAckRateProperty()
    {
        return $this->rule->acknowledgementRate();
    }

    public function getIsAckedProperty()
    {
        return $this->rule->isAcknowledgedBy(Auth::id());
    }

    /* ── Actions ──────────── */

    public function acknowledge()
    {
        RuleAcknowledgement::firstOrCreate(
            ['rule_id' => $this->rule->id, 'user_id' => Auth::id()],
            ['acknowledged_at' => now()]
        );

        // Reload to reflect new acknowledgement
        $this->rule = Rule::with([
            'creator',
            'villageBank',
            'acknowledgements.user',
        ])->findOrFail($this->rule->id);

        session()->flash('message', 'Rule acknowledged successfully.');
    }

    public function render()
    {
        return view('livewire.village-banking.rules.rule-show')
            ->layout('layouts.main.master-livewire');
    }
}
