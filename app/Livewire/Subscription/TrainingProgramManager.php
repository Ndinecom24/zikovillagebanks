<?php

namespace App\Livewire\Subscription;

use App\Models\Subscription\TrainingProgram;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TrainingProgramManager extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $filterStatus = '';
    public $perPage = 10;

    /* ── Modal state ── */
    public $showModal = false;
    public $editId = null;

    /* ── Form fields ── */
    public $title = '';
    public $description = '';
    public $category = 'general';
    public $trainer = '';
    public $location = '';
    public $startDate = '';
    public $endDate = '';
    public $duration = '';
    public $fee = 0;
    public $maxParticipants = '';
    public $coverImage;
    public $status = 'draft';
    public $isFeatured = false;
    public $sortOrder = 0;

    /* ── Delete ── */
    public $confirmDeleteId = null;

    protected function rules()
    {
        return [
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string|max:5000',
            'category'        => 'required|in:general,finance,governance,management,leadership',
            'trainer'         => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
            'startDate'       => 'nullable|date',
            'endDate'         => 'nullable|date|after_or_equal:startDate',
            'duration'        => 'nullable|string|max:100',
            'fee'             => 'numeric|min:0',
            'maxParticipants' => 'nullable|integer|min:1',
            'coverImage'      => 'nullable|image|max:5120',
            'status'          => 'required|in:draft,published,closed,completed',
            'isFeatured'      => 'boolean',
            'sortOrder'       => 'integer|min:0',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* ── Modal actions ─────────────── */

    public function openCreate()
    {
        $this->resetForm();
        $this->editId = null;
        $this->showModal = true;
    }

    public function openEdit($id)
    {
        $program = TrainingProgram::findOrFail($id);
        $this->editId         = $program->id;
        $this->title          = $program->title;
        $this->description    = $program->description ?? '';
        $this->category       = $program->category;
        $this->trainer        = $program->trainer ?? '';
        $this->location       = $program->location ?? '';
        $this->startDate      = $program->start_date ? $program->start_date->format('Y-m-d') : '';
        $this->endDate        = $program->end_date ? $program->end_date->format('Y-m-d') : '';
        $this->duration       = $program->duration ?? '';
        $this->fee            = $program->fee;
        $this->maxParticipants = $program->max_participants ?? '';
        $this->status         = $program->status;
        $this->isFeatured     = $program->is_featured;
        $this->sortOrder      = $program->sort_order;
        $this->showModal      = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title'            => $this->title,
            'description'      => $this->description ?: null,
            'category'         => $this->category,
            'trainer'          => $this->trainer ?: null,
            'location'         => $this->location ?: null,
            'start_date'       => $this->startDate ?: null,
            'end_date'         => $this->endDate ?: null,
            'duration'         => $this->duration ?: null,
            'fee'              => $this->fee,
            'max_participants' => $this->maxParticipants ?: null,
            'status'           => $this->status,
            'is_featured'      => $this->isFeatured,
            'sort_order'       => $this->sortOrder,
        ];

        if ($this->coverImage) {
            $data['cover_image'] = $this->coverImage->store('training_covers', 'public');
        }

        TrainingProgram::updateOrCreate(['id' => $this->editId], $data);

        $this->showModal = false;
        $this->resetForm();

        session()->flash('success', $this->editId ? 'Training program updated.' : 'Training program created.');
    }

    public function toggleStatus($id, $newStatus)
    {
        $program = TrainingProgram::findOrFail($id);
        $program->update(['status' => $newStatus]);
        session()->flash('success', "Program \"{$program->title}\" set to {$newStatus}.");
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
    }

    public function delete()
    {
        if ($this->confirmDeleteId) {
            TrainingProgram::destroy($this->confirmDeleteId);
            $this->confirmDeleteId = null;
            session()->flash('success', 'Training program deleted.');
        }
    }

    public function cancelDelete()
    {
        $this->confirmDeleteId = null;
    }

    private function resetForm()
    {
        $this->reset([
            'title', 'description', 'category', 'trainer', 'location',
            'startDate', 'endDate', 'duration', 'fee', 'maxParticipants',
            'coverImage', 'status', 'isFeatured', 'sortOrder', 'editId',
        ]);
        $this->category = 'general';
        $this->status = 'draft';
        $this->fee = 0;
        $this->sortOrder = 0;
        $this->isFeatured = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        $programs = TrainingProgram::query()
            ->when($this->search, function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('trainer', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%');
            })
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->withCount('applications')
            ->orderBy('sort_order')
            ->orderBy('start_date', 'desc')
            ->paginate($this->perPage);

        return view('livewire.subscription.training-program-manager', compact('programs'));
    }
}
