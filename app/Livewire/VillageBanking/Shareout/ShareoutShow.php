<?php

namespace App\Livewire\VillageBanking\Shareout;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\VillageBanking\Shareout;

#[Layout('layouts.main.master-livewire')]
class ShareoutShow extends Component
{
    public Shareout $shareout;

    public function mount($shareoutId)
    {
        $this->shareout = Shareout::with([
            'circle.villageBank',
            'allocations.user',
        ])->findOrFail($shareoutId);
    }

    /* ── Computed helpers ──────────── */

    public function getTotalMembersProperty()
    {
        return $this->shareout->allocations->count();
    }

    public function getAvgPayoutProperty()
    {
        $count = $this->totalMembers;
        return $count > 0 ? $this->shareout->total_pool / $count : 0;
    }

    public function getHighestPayoutProperty()
    {
        return $this->shareout->allocations->max('payout_amount') ?? 0;
    }

    public function getLowestPayoutProperty()
    {
        return $this->shareout->allocations->min('payout_amount') ?? 0;
    }

    public function render()
    {
        return view('livewire.village-banking.shareout.shareout-show');
    }
}
