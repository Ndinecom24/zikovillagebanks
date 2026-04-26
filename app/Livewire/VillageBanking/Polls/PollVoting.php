<?php

namespace App\Livewire\VillageBanking\Polls;

use App\Models\VillageBanking\Poll;
use App\Models\VillageBanking\PollComment;
use App\Models\VillageBanking\PollVote;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class PollVoting extends Component
{
    use HasVillageBankScope;

    /* ── Active poll ─────────────────── */
    public $activePollId = '';

    /* ── Voting ──────────────────────── */
    public $selectedOption = '';       // single-choice
    public $selectedOptions = [];      // multi-choice

    /* ── Comments ────────────────────── */
    public $commentBody = '';

    /* ── Feedback ────────────────────── */
    public $successMessage = '';

    public function updatedActivePollId()
    {
        $this->reset(['selectedOption', 'selectedOptions', 'commentBody', 'successMessage']);

        // Pre-populate if already voted
        if ($this->activePollId) {
            $poll = Poll::find($this->activePollId);
            if ($poll) {
                $userVotes = $poll->userVotes(Auth::id());
                if ($poll->type === 'single' && $userVotes->isNotEmpty()) {
                    $this->selectedOption = $userVotes->first();
                } elseif ($poll->type === 'multiple') {
                    $this->selectedOptions = $userVotes->toArray();
                }
            }
        }
    }

    /* ── Cast Vote ───────────────────── */

    public function castVote()
    {
        $poll = Poll::with('options')->findOrFail($this->activePollId);

        if (!$poll->isOpen()) {
            session()->flash('warning', 'This poll is not open for voting.');
            return;
        }

        $userId = Auth::id();

        // Check if user is a member of the village bank
        $isMember = $poll->villageBank->members()->where('users.id', $userId)->exists();
        if (!$isMember) {
            session()->flash('warning', 'You are not a member of this village bank.');
            return;
        }

        if ($poll->type === 'single') {
            $this->validate([
                'selectedOption' => 'required|exists:poll_options,id',
            ], [
                'selectedOption.required' => 'Select an option to vote.',
            ]);

            // Remove existing vote for this poll (re-vote)
            PollVote::where('poll_id', $poll->id)->where('user_id', $userId)->delete();

            PollVote::create([
                'poll_id'        => $poll->id,
                'poll_option_id' => $this->selectedOption,
                'user_id'        => $userId,
            ]);
        } else {
            $this->validate([
                'selectedOptions'   => 'required|array|min:1',
                'selectedOptions.*' => 'exists:poll_options,id',
            ], [
                'selectedOptions.required' => 'Select at least one option.',
                'selectedOptions.min'      => 'Select at least one option.',
            ]);

            // Remove existing votes
            PollVote::where('poll_id', $poll->id)->where('user_id', $userId)->delete();

            foreach ($this->selectedOptions as $optionId) {
                PollVote::create([
                    'poll_id'        => $poll->id,
                    'poll_option_id' => $optionId,
                    'user_id'        => $userId,
                ]);
            }
        }

        $this->successMessage = 'Your vote has been recorded.';
    }

    /* ── Add Comment ─────────────────── */

    public function addComment()
    {
        $this->validate([
            'commentBody' => 'required|string|min:2|max:1000',
        ], [
            'commentBody.required' => 'Enter a comment.',
            'commentBody.min'      => 'Comment must be at least 2 characters.',
        ]);

        PollComment::create([
            'poll_id' => $this->activePollId,
            'user_id' => Auth::id(),
            'body'    => $this->commentBody,
        ]);

        $this->commentBody = '';
    }

    /* ── Computed: active polls ───────── */

    public function getActivePollsProperty()
    {
        $query = Poll::where('status', 'active')
            ->with('villageBank')
            ->withCount('votes');

        if (!empty($this->villageBankId)) {
            $query->where('village_bank_id', $this->villageBankId);
        }

        return $query->orderByDesc('created_at')->get();
    }

    /* ── Computed: current poll detail ── */

    public function getCurrentPollProperty()
    {
        if (empty($this->activePollId)) return null;

        return Poll::with([
            'options.votes',
            'comments.user',
            'villageBank',
            'creator',
        ])->find($this->activePollId);
    }

    public function render()
    {
        return view('livewire.village-banking.polls.poll-voting', [
            'activePolls' => $this->activePolls,
            'currentPoll' => $this->currentPoll,
        ]);
    }
}
