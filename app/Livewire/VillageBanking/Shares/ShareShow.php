<?php

namespace App\Livewire\VillageBanking\Shares;

use App\Models\VillageBanking\InsuranceConfig;
use App\Models\VillageBanking\InsuranceContribution;
use App\Models\VillageBanking\ShareDeclaration as ShareDeclarationModel;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class ShareShow extends Component
{
    public $declarationId;
    public $declaration;

    // Related data
    public $insuranceContribution = null;
    public $insuranceConfig = null;
    public $memberTotalShares = 0;
    public $memberDeclarationsCount = 0;
    public $circleDeclarationsCount = 0;
    public $circleTotalShares = 0;
    public $memberShareRank = 0;

    // Tab
    public $activeTab = 'overview';

    public function mount($declarationId)
    {
        $this->declarationId = $declarationId;

        $this->declaration = ShareDeclarationModel::with([
            'user',
            'month.circle.villageBank',
            'month.circle.creator',
        ])->findOrFail($declarationId);

        $circle = $this->declaration->month->circle;
        $month  = $this->declaration->month;
        $userId = $this->declaration->user_id;

        // Insurance
        $this->insuranceContribution = InsuranceContribution::where('user_id', $userId)
            ->where('month_id', $month->id)
            ->first();

        $this->insuranceConfig = InsuranceConfig::where('circle_id', $circle->id)->first();

        // Member's total shares in this circle (across all months)
        $this->memberTotalShares = ShareDeclarationModel::where('user_id', $userId)
            ->whereHas('month', function ($q) use ($circle) {
                $q->where('circle_id', $circle->id);
            })->sum('amount');

        // Count of declarations by this member in this circle
        $this->memberDeclarationsCount = ShareDeclarationModel::where('user_id', $userId)
            ->whereHas('month', function ($q) use ($circle) {
                $q->where('circle_id', $circle->id);
            })->count();

        // Circle-wide stats for this month
        $this->circleDeclarationsCount = ShareDeclarationModel::where('month_id', $month->id)->count();
        $this->circleTotalShares = ShareDeclarationModel::where('month_id', $month->id)->sum('amount');

        // Member's rank in this month by share amount
        $this->memberShareRank = ShareDeclarationModel::where('month_id', $month->id)
            ->where('amount', '>', $this->declaration->amount)
            ->count() + 1;
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        // Member's all declarations in this circle
        $memberHistory = ShareDeclarationModel::with('month')
            ->where('user_id', $this->declaration->user_id)
            ->whereHas('month', function ($q) {
                $q->where('circle_id', $this->declaration->month->circle->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // All declarations for this month
        $monthDeclarations = ShareDeclarationModel::with('user')
            ->where('month_id', $this->declaration->month_id)
            ->orderByDesc('amount')
            ->get();

        return view('livewire.village-banking.shares.share-show', [
            'memberHistory'     => $memberHistory,
            'monthDeclarations' => $monthDeclarations,
        ]);
    }
}
