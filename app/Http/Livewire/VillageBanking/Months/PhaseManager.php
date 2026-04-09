<?php

namespace App\Http\Livewire\VillageBanking\Months;

use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Phase;
use Carbon\Carbon;
use Livewire\Component;

class PhaseManager extends Component
{
    public $monthId;
    public $month;

    // Create / Edit
    public $showFormModal = false;
    public $editingId = null;
    public $phaseName = '';
    public $phaseStartDate = '';
    public $phaseEndDate = '';

    // Status
    public $statusPhaseId;
    public $targetStatus = '';
    public $showStatusModal = false;

    // Delete
    public $deleteId;
    public $deleteLabel;

    // Default phase templates
    public $defaultPhases = [
        ['name' => 'Share Collection',   'days' => 7],
        ['name' => 'Loan Processing',    'days' => 7],
        ['name' => 'Repayment Window',   'days' => 10],
        ['name' => 'Reconciliation',     'days' => 6],
    ];

    public function mount($monthId)
    {
        $this->monthId = $monthId;
        $this->month = Month::with('circle')->findOrFail($monthId);
    }

    /* ── Auto-generate default phases ──── */

    public function generateDefaults()
    {
        $existing = Phase::where('month_id', $this->monthId)->count();
        if ($existing > 0) {
            session()->flash('warning', 'Phases already exist for this month.');
            return;
        }

        $cursor = Carbon::parse($this->month->start_date)->startOfDay();

        foreach ($this->defaultPhases as $template) {
            $start = $cursor->copy();
            $end = $cursor->copy()->addDays($template['days'] - 1)->endOfDay();

            Phase::create([
                'month_id'   => $this->monthId,
                'name'       => $template['name'],
                'start_date' => $start,
                'end_date'   => $end,
                'status'     => 'pending',
            ]);

            $cursor = $end->copy()->addDay()->startOfDay();
        }

        session()->flash('message', count($this->defaultPhases) . ' default phases generated.');
    }

    /* ── Create / Edit modal ────────────── */

    public function openCreate()
    {
        $this->resetForm();
        $lastPhase = Phase::where('month_id', $this->monthId)
            ->orderBy('end_date', 'desc')
            ->first();

        if ($lastPhase) {
            $this->phaseStartDate = Carbon::parse($lastPhase->end_date)->addDay()->format('Y-m-d\TH:i');
        } else {
            $this->phaseStartDate = Carbon::parse($this->month->start_date)->format('Y-m-d\TH:i');
        }

        $this->showFormModal = true;
    }

    public function openEdit($id)
    {
        $phase = Phase::findOrFail($id);
        $this->editingId = $phase->id;
        $this->phaseName = $phase->name;
        $this->phaseStartDate = Carbon::parse($phase->start_date)->format('Y-m-d\TH:i');
        $this->phaseEndDate = Carbon::parse($phase->end_date)->format('Y-m-d\TH:i');
        $this->showFormModal = true;
    }

    public function savePhase()
    {
        $this->validate([
            'phaseName'      => 'required|string|max:255',
            'phaseStartDate' => 'required|date',
            'phaseEndDate'   => 'required|date|after:phaseStartDate',
        ], [
            'phaseName.required'      => 'Phase name is required.',
            'phaseStartDate.required' => 'Start date/time is required.',
            'phaseEndDate.required'   => 'End date/time is required.',
            'phaseEndDate.after'      => 'End must be after start.',
        ]);

        $data = [
            'month_id'   => $this->monthId,
            'name'       => $this->phaseName,
            'start_date' => $this->phaseStartDate,
            'end_date'   => $this->phaseEndDate,
        ];

        if ($this->editingId) {
            Phase::findOrFail($this->editingId)->update($data);
            session()->flash('message', 'Phase updated.');
        } else {
            $data['status'] = 'pending';
            Phase::create($data);
            session()->flash('message', 'Phase created.');
        }

        $this->showFormModal = false;
        $this->resetForm();
    }

    /* ── Status transitions ─────────────── */

    public function openStatusModal($phaseId, $status)
    {
        $this->statusPhaseId = $phaseId;
        $this->targetStatus = $status;
        $this->showStatusModal = true;
    }

    public function changePhaseStatus()
    {
        $phase = Phase::findOrFail($this->statusPhaseId);

        $allowed = [
            'pending' => ['active'],
            'active'  => ['completed'],
        ];

        if (!isset($allowed[$phase->status]) || !in_array($this->targetStatus, $allowed[$phase->status])) {
            session()->flash('warning', 'Invalid status transition.');
            $this->showStatusModal = false;
            return;
        }

        // Only one active phase per month
        if ($this->targetStatus === 'active') {
            $activeExists = Phase::where('month_id', $this->monthId)
                ->where('status', 'active')
                ->exists();
            if ($activeExists) {
                session()->flash('warning', 'Complete the current active phase before activating another.');
                $this->showStatusModal = false;
                return;
            }
        }

        $phase->update(['status' => $this->targetStatus]);
        session()->flash('message', $phase->name . ' status changed to ' . $this->targetStatus . '.');
        $this->showStatusModal = false;
    }

    /* ── Delete ───────────────────────── */

    public function confirmDelete($id)
    {
        $phase = Phase::find($id);
        if ($phase && $phase->status === 'pending') {
            $this->deleteId = $id;
            $this->deleteLabel = $phase->name;
        }
    }

    public function deletePhase()
    {
        $phase = Phase::find($this->deleteId);
        if ($phase && $phase->status === 'pending') {
            $phase->delete();
            session()->flash('message', $this->deleteLabel . ' deleted.');
        }
        $this->reset(['deleteId', 'deleteLabel']);
    }

    /* ── Helpers ──────────────────────── */

    public function resetForm()
    {
        $this->reset(['editingId', 'phaseName', 'phaseStartDate', 'phaseEndDate']);
        $this->resetErrorBag();
    }

    public function render()
    {
        $phases = Phase::where('month_id', $this->monthId)
            ->orderBy('start_date')
            ->get();

        return view('livewire.village-banking.months.phase-manager', compact(
            'phases',
        ))->layout('layouts.main.master-livewire');
    }
}
