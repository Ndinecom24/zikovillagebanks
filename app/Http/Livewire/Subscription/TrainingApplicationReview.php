<?php

namespace App\Http\Livewire\Subscription;

use App\Models\Subscription\TrainingApplication;
use App\Models\Subscription\TrainingProgram;
use Livewire\Component;
use Livewire\WithPagination;

class TrainingApplicationReview extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $filterStatus = '';
    public $filterProgram = '';
    public $perPage = 15;

    /* ── Detail / action modal ── */
    public $showDetailModal = false;
    public $selectedApp = null;
    public $adminNotes = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function viewApplication($id)
    {
        $this->selectedApp = TrainingApplication::with('program')->findOrFail($id);
        $this->adminNotes = $this->selectedApp->admin_notes ?? '';
        $this->showDetailModal = true;
    }

    public function approve()
    {
        if ($this->selectedApp) {
            $this->selectedApp->update([
                'status'      => 'approved',
                'admin_notes' => $this->adminNotes ?: null,
                'approved_at' => now(),
            ]);
            session()->flash('success', $this->selectedApp->full_name . ' approved for training.');
            $this->showDetailModal = false;
            $this->selectedApp = null;
        }
    }

    public function reject()
    {
        if ($this->selectedApp) {
            $this->selectedApp->update([
                'status'      => 'rejected',
                'admin_notes' => $this->adminNotes ?: null,
            ]);
            session()->flash('success', $this->selectedApp->full_name . ' application rejected.');
            $this->showDetailModal = false;
            $this->selectedApp = null;
        }
    }

    public function quickApprove($id)
    {
        $app = TrainingApplication::findOrFail($id);
        $app->update(['status' => 'approved', 'approved_at' => now()]);
        session()->flash('success', $app->full_name . ' approved.');
    }

    public function quickReject($id)
    {
        $app = TrainingApplication::findOrFail($id);
        $app->update(['status' => 'rejected']);
        session()->flash('success', $app->full_name . ' rejected.');
    }

    public function closeModal()
    {
        $this->showDetailModal = false;
        $this->selectedApp = null;
        $this->adminNotes = '';
    }

    public function render()
    {
        $applications = TrainingApplication::with('program')
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('full_name', 'like', '%' . $this->search . '%')
                       ->orWhere('email', 'like', '%' . $this->search . '%')
                       ->orWhere('village_bank', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->when($this->filterProgram, fn($q) => $q->where('training_program_id', $this->filterProgram))
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        $programs = TrainingProgram::orderBy('title')->get();

        $stats = [
            'total'    => TrainingApplication::count(),
            'pending'  => TrainingApplication::where('status', 'pending')->count(),
            'approved' => TrainingApplication::where('status', 'approved')->count(),
            'rejected' => TrainingApplication::where('status', 'rejected')->count(),
        ];

        return view('livewire.subscription.training-application-review', compact('applications', 'programs', 'stats'));
    }
}
