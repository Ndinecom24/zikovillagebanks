<?php

namespace App\Http\Livewire\VillageBanking\Polls;

use App\Models\VillageBanking\Poll;
use App\Models\VillageBanking\PollOption;
use App\Models\VillageBanking\PollComment;
use App\Models\VillageBanking\PollVote;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PollManager extends Component
{
    use WithPagination, HasVillageBankScope;

    protected $paginationTheme = 'bootstrap';

    /* ── Filters ─────────────────────── */
    public $search = '';
    public $statusFilter = '';
    public $perPage = 10;

    /* ── Create / Edit ───────────────── */
    public $showFormModal = false;
    public $editingId = null;
    public $formBankId = '';
    public $question = '';
    public $description = '';
    public $pollType = 'single';
    public $isAnonymous = false;
    public $startsAt = '';
    public $endsAt = '';
    public $options = ['', ''];   // start with 2 blank options

    /* ── Delete ───────────────────────── */
    public $deleteId;
    public $deleteQuestion;

    protected $queryString = [
        'search'         => ['except' => ''],
        'statusFilter'   => ['except' => '', 'as' => 'status'],
        'villageBankId'  => ['except' => '', 'as' => 'bank'],
    ];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatusFilter() { $this->resetPage(); }

    /* ── Form: Open Create ───────────── */

    public function openCreate()
    {
        $this->resetForm();
        $this->formBankId = $this->villageBankId;
        $this->showFormModal = true;
    }

    /* ── Form: Open Edit ─────────────── */

    public function openEdit($id)
    {
        $poll = Poll::with('options')->findOrFail($id);

        if ($poll->status !== 'draft') {
            session()->flash('warning', 'Only draft polls can be edited.');
            return;
        }

        $this->editingId   = $poll->id;
        $this->formBankId  = $poll->village_bank_id;
        $this->question    = $poll->question;
        $this->description = $poll->description ?? '';
        $this->pollType    = $poll->type;
        $this->isAnonymous = $poll->is_anonymous;
        $this->startsAt    = $poll->starts_at ? $poll->starts_at->format('Y-m-d\TH:i') : '';
        $this->endsAt      = $poll->ends_at ? $poll->ends_at->format('Y-m-d\TH:i') : '';
        $this->options     = $poll->options->pluck('label')->toArray();

        if (count($this->options) < 2) {
            $this->options = array_pad($this->options, 2, '');
        }

        $this->showFormModal = true;
    }

    /* ── Form: Add / Remove Option ───── */

    public function addOption()
    {
        if (count($this->options) < 10) {
            $this->options[] = '';
        }
    }

    public function removeOption($index)
    {
        if (count($this->options) > 2) {
            unset($this->options[$index]);
            $this->options = array_values($this->options);
        }
    }

    /* ── Form: Save ──────────────────── */

    public function savePoll()
    {
        $this->validate([
            'formBankId' => 'required|exists:village_banks,id',
            'question'   => 'required|string|max:500',
            'pollType'   => 'required|in:single,multiple',
            'options'    => 'required|array|min:2',
            'options.*'  => 'required|string|max:255',
            'startsAt'   => 'nullable|date',
            'endsAt'     => 'nullable|date|after:startsAt',
        ], [
            'formBankId.required' => 'Select a village bank.',
            'question.required'   => 'The question is required.',
            'options.min'         => 'At least 2 options are required.',
            'options.*.required'  => 'Each option must have a label.',
            'endsAt.after'        => 'End date must be after start date.',
        ]);

        $data = [
            'village_bank_id' => $this->formBankId,
            'question'        => $this->question,
            'description'     => $this->description ?: null,
            'type'            => $this->pollType,
            'is_anonymous'    => $this->isAnonymous,
            'starts_at'       => $this->startsAt ?: null,
            'ends_at'         => $this->endsAt ?: null,
        ];

        if ($this->editingId) {
            $poll = Poll::findOrFail($this->editingId);
            $poll->update($data);
            // Rebuild options
            $poll->options()->delete();
        } else {
            $data['created_by'] = Auth::id();
            $data['status'] = 'draft';
            $poll = Poll::create($data);
        }

        foreach ($this->options as $i => $label) {
            PollOption::create([
                'poll_id'    => $poll->id,
                'label'      => trim($label),
                'sort_order' => $i,
            ]);
        }

        session()->flash('message', $this->editingId ? 'Poll updated.' : 'Poll created as draft.');
        $this->showFormModal = false;
        $this->resetForm();
    }

    /* ── Status Transitions ──────────── */

    public function activatePoll($id)
    {
        $poll = Poll::findOrFail($id);
        if ($poll->status !== 'draft') {
            session()->flash('warning', 'Only draft polls can be activated.');
            return;
        }
        if ($poll->options()->count() < 2) {
            session()->flash('warning', 'Poll must have at least 2 options.');
            return;
        }
        $poll->update([
            'status'    => 'active',
            'starts_at' => $poll->starts_at ?? now(),
        ]);
        session()->flash('message', 'Poll is now active and open for voting.');
    }

    public function closePoll($id)
    {
        $poll = Poll::findOrFail($id);
        if ($poll->status !== 'active') {
            session()->flash('warning', 'Only active polls can be closed.');
            return;
        }
        $poll->update([
            'status' => 'closed',
            'ends_at' => now(),
        ]);
        session()->flash('message', 'Poll closed. No more votes can be cast.');
    }

    /* ── Delete ───────────────────────── */

    public function confirmDelete($id)
    {
        $poll = Poll::find($id);
        if ($poll) {
            $this->deleteId = $id;
            $this->deleteQuestion = $poll->question;
        }
    }

    public function deletePoll()
    {
        $poll = Poll::find($this->deleteId);
        if ($poll) {
            $poll->delete();
        }
        session()->flash('message', 'Poll deleted.');
        $this->reset(['deleteId', 'deleteQuestion']);
    }

    /* ── Helpers ──────────────────────── */

    private function resetForm()
    {
        $this->reset(['editingId', 'question', 'description', 'startsAt', 'endsAt', 'formBankId']);
        $this->pollType = 'single';
        $this->isAnonymous = false;
        $this->options = ['', ''];
        $this->resetErrorBag();
    }

    /* ── Render ───────────────────────── */

    public function render()
    {
        $query = Poll::with(['villageBank', 'creator'])
            ->withCount(['options', 'votes']);

        if (!empty($this->villageBankId)) {
            $query->where('village_bank_id', $this->villageBankId);
        }

        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('question', 'like', $term)
                  ->orWhere('description', 'like', $term);
            });
        }

        $polls = $query->orderByDesc('created_at')->paginate($this->perPage);

        // Stats
        $baseQuery = Poll::query();
        if (!empty($this->villageBankId)) {
            $baseQuery->where('village_bank_id', $this->villageBankId);
        }
        $totalPolls  = (clone $baseQuery)->count();
        $activePolls = (clone $baseQuery)->where('status', 'active')->count();
        $totalVotes  = PollVote::when(!empty($this->villageBankId), function ($q) {
            $q->whereHas('poll', fn ($p) => $p->where('village_bank_id', $this->villageBankId));
        })->count();

        return view('livewire.village-banking.polls.poll-manager', compact(
            'polls', 'totalPolls', 'activePolls', 'totalVotes',
        ))->layout('layouts.main.master-livewire');
    }
}
