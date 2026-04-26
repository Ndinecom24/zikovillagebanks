<?php

namespace App\Livewire\VillageBanking\Months;

use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\VillageBankMonthConfig;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class MonthManager extends Component
{
    public $circleId;
    public $circle;

    // Auto-generate form
    public $showGenerateModal = false;

    // Manual add
    public $showAddModal = false;
    public $monthNumber;
    public $startDate = '';
    public $endDate = '';

    // Status change
    public $statusMonthId;
    public $targetStatus = '';
    public $showStatusModal = false;

    // Delete
    public $deleteId;
    public $deleteNumber;

    public function mount($circleId)
    {
        $this->circleId = $circleId;
        $this->circle = Circle::withCount('members')->findOrFail($circleId);
    }

    /* ── Auto-generate all months ──────── */

    public function openGenerateModal()
    {
        $this->showGenerateModal = true;
    }

    public function generateMonths()
    {
        if ($this->circle->status !== 'active') {
            session()->flash('warning', 'Circle must be active to generate months.');
            $this->showGenerateModal = false;
            return;
        }

        $existing = Month::where('circle_id', $this->circleId)->count();
        if ($existing > 0) {
            session()->flash('warning', 'Months have already been generated for this circle.');
            $this->showGenerateModal = false;
            return;
        }

        $start = Carbon::parse($this->circle->start_date);

        // Load month configs from the village bank (if any)
        $bankId = $this->circle->village_bank_id;
        $monthConfigMap = [];
        if ($bankId) {
            $monthConfigMap = VillageBankMonthConfig::where('village_bank_id', $bankId)
                ->get()
                ->keyBy('month_number')
                ->toArray();
        }

        for ($i = 1; $i <= $this->circle->duration_months; $i++) {
            $monthStart = $start->copy()->addMonths($i - 1);
            $monthEnd = $monthStart->copy()->addMonth()->subDay();

            $cfg = $monthConfigMap[$i] ?? null;

            Month::create([
                'circle_id'                    => $this->circleId,
                'month_number'                 => $i,
                'label'                        => $cfg['label'] ?? null,
                'start_date'                   => $monthStart->format('Y-m-d'),
                'end_date'                     => $monthEnd->format('Y-m-d'),
                'status'                       => $i === 1 ? 'active' : 'pending',
                'allow_share_declarations'     => $cfg ? (bool) $cfg['allow_share_declarations'] : true,
                'allow_insurance_declarations' => $cfg ? (bool) $cfg['allow_insurance_declarations'] : true,
                'allow_loan_requests'          => $cfg ? (bool) $cfg['allow_loan_requests'] : true,
                'allow_loan_repayments'        => $cfg ? (bool) $cfg['allow_loan_repayments'] : true,
                'is_shareout_month'            => $cfg ? (bool) $cfg['is_shareout_month'] : ($i === $this->circle->duration_months),
            ]);
        }

        session()->flash('message', $this->circle->duration_months . ' months generated successfully. Month 1 set to active.');
        $this->showGenerateModal = false;
    }

    /* ── Manual add month ──────────────── */

    public function openAddModal()
    {
        $lastMonth = Month::where('circle_id', $this->circleId)
            ->orderBy('month_number', 'desc')
            ->first();

        $this->monthNumber = $lastMonth ? $lastMonth->month_number + 1 : 1;

        if ($lastMonth) {
            $this->startDate = Carbon::parse($lastMonth->end_date)->addDay()->format('Y-m-d');
            $this->endDate = Carbon::parse($this->startDate)->addMonth()->subDay()->format('Y-m-d');
        } else {
            $this->startDate = $this->circle->start_date->format('Y-m-d');
            $this->endDate = $this->circle->start_date->copy()->addMonth()->subDay()->format('Y-m-d');
        }

        $this->showAddModal = true;
    }

    public function addMonth()
    {
        $this->validate([
            'monthNumber' => 'required|integer|min:1',
            'startDate'   => 'required|date',
            'endDate'     => 'required|date|after:startDate',
        ]);

        $existing = Month::where('circle_id', $this->circleId)
            ->where('month_number', $this->monthNumber)
            ->exists();

        if ($existing) {
            $this->addError('monthNumber', 'Month #' . $this->monthNumber . ' already exists.');
            return;
        }

        Month::create([
            'circle_id'    => $this->circleId,
            'month_number' => $this->monthNumber,
            'start_date'   => $this->startDate,
            'end_date'     => $this->endDate,
            'status'       => 'pending',
        ]);

        session()->flash('message', 'Month #' . $this->monthNumber . ' added.');
        $this->showAddModal = false;
        $this->reset(['monthNumber', 'startDate', 'endDate']);
    }

    /* ── Status transitions ─────────────── */

    public function openStatusModal($monthId, $status)
    {
        $this->statusMonthId = $monthId;
        $this->targetStatus = $status;
        $this->showStatusModal = true;
    }

    public function changeMonthStatus()
    {
        $month = Month::findOrFail($this->statusMonthId);

        $allowed = [
            'pending' => ['active'],
            'active'  => ['closed'],
        ];

        if (!isset($allowed[$month->status]) || !in_array($this->targetStatus, $allowed[$month->status])) {
            session()->flash('warning', 'Invalid status transition.');
            $this->showStatusModal = false;
            return;
        }

        // Only one active month at a time
        if ($this->targetStatus === 'active') {
            $activeExists = Month::where('circle_id', $this->circleId)
                ->where('status', 'active')
                ->exists();
            if ($activeExists) {
                session()->flash('warning', 'Close the current active month before activating a new one.');
                $this->showStatusModal = false;
                return;
            }
        }

        $month->update(['status' => $this->targetStatus]);
        session()->flash('message', 'Month #' . $month->month_number . ' status changed to ' . $this->targetStatus . '.');
        $this->showStatusModal = false;
    }

    /* ── Delete month ──────────────────── */

    public function confirmDelete($id)
    {
        $month = Month::find($id);
        if ($month && $month->status === 'pending') {
            $this->deleteId = $id;
            $this->deleteNumber = $month->month_number;
        }
    }

    public function deleteMonth()
    {
        $month = Month::find($this->deleteId);
        if ($month && $month->status === 'pending') {
            $month->delete();
            session()->flash('message', 'Month #' . $this->deleteNumber . ' deleted.');
        }
        $this->reset(['deleteId', 'deleteNumber']);
    }

    /* ── Render ───────────────────────── */

    public function render()
    {
        $months = Month::where('circle_id', $this->circleId)
            ->withCount('phases')
            ->orderBy('month_number')
            ->get();

        return view('livewire.village-banking.months.month-manager', compact(
            'months',
        ));
    }
}
