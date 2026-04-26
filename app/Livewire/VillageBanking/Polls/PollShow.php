<?php

namespace App\Livewire\VillageBanking\Polls;

use App\Models\VillageBanking\Poll;
use App\Models\VillageBanking\PollComment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class PollShow extends Component
{
    public $pollId;
    public $poll;

    /* ── Comments ────────────────────── */
    public $commentBody = '';

    public function mount($pollId)
    {
        $this->pollId = $pollId;
        $this->loadPoll();
    }

    private function loadPoll()
    {
        $this->poll = Poll::with([
            'options.votes.voter',
            'votes.voter',
            'comments.user',
            'villageBank',
            'creator',
        ])->findOrFail($this->pollId);
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
            'poll_id' => $this->pollId,
            'user_id' => Auth::id(),
            'body'    => $this->commentBody,
        ]);

        $this->commentBody = '';
        $this->loadPoll(); // reload comments
    }

    /* ── Computed helpers ────────────── */

    public function getTotalVotesProperty()
    {
        return $this->poll->totalVotes();
    }

    public function getTotalVotersProperty()
    {
        return $this->poll->totalVoters();
    }

    public function getParticipationRateProperty()
    {
        return $this->poll->participationRate();
    }

    public function getWinningOptionProperty()
    {
        if ($this->totalVotes === 0) return null;

        return $this->poll->options->sortByDesc(function ($o) {
            return $o->votes->count();
        })->first();
    }

    public function render()
    {
        return view('livewire.village-banking.polls.poll-show');
    }
}
