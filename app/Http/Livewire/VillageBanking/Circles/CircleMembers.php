<?php

namespace App\Http\Livewire\VillageBanking\Circles;

use App\Models\User;
use App\Models\VillageBanking\Circle;
use Livewire\Component;
use Livewire\WithPagination;

class CircleMembers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $circleId;
    public $circle;

    // Add member
    public $memberSearch = '';
    public $showMemberResults = false;

    // Remove member
    public $removeId;
    public $removeName;

    // Status transition
    public $showStatusModal = false;
    public $targetStatus = '';

    public function mount($circleId)
    {
        $this->circleId = $circleId;
        $this->circle = Circle::withCount('members')->findOrFail($circleId);
    }

    /* ── Member search ───────────────────── */

    public function updatedMemberSearch()
    {
        $this->showMemberResults = strlen($this->memberSearch) >= 2;
    }

    public function getMemberResultsProperty()
    {
        if (strlen($this->memberSearch) < 2) {
            return collect();
        }

        $term = '%' . trim($this->memberSearch) . '%';
        $existingIds = $this->circle->members()->pluck('users.id')->toArray();

        return User::where('status', 'active')
            ->whereNotIn('id', $existingIds)
            ->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('email', 'like', $term)
                  ->orWhere('phone', 'like', $term);
            })
            ->limit(10)
            ->get(['id', 'name', 'email', 'phone']);
    }

    public function addMember($userId)
    {
        $user = User::findOrFail($userId);

        // Prevent duplicate
        if (!$this->circle->members()->where('users.id', $userId)->exists()) {
            $this->circle->members()->attach($userId, ['joined_at' => now()]);
            session()->flash('message', $user->name . ' added to circle.');
        }

        $this->memberSearch = '';
        $this->showMemberResults = false;
        $this->refreshCircle();
    }

    /* ── Remove member ───────────────────── */

    public function confirmRemove($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $this->removeId = $userId;
            $this->removeName = $user->name;
        }
    }

    public function removeMember()
    {
        $this->circle->members()->detach($this->removeId);
        session()->flash('message', $this->removeName . ' removed from circle.');
        $this->reset(['removeId', 'removeName']);
        $this->refreshCircle();
    }

    /* ── Status lifecycle ────────────────── */

    public function openStatusModal($status)
    {
        $this->targetStatus = $status;
        $this->showStatusModal = true;
    }

    public function changeStatus()
    {
        $allowed = [
            'draft'     => ['active'],
            'active'    => ['completed'],
        ];

        $current = $this->circle->status;

        if (!isset($allowed[$current]) || !in_array($this->targetStatus, $allowed[$current])) {
            session()->flash('warning', 'Invalid status transition.');
            $this->showStatusModal = false;
            return;
        }

        // Cannot activate with zero members
        if ($this->targetStatus === 'active' && $this->circle->members()->count() === 0) {
            session()->flash('warning', 'Cannot activate a circle with no members.');
            $this->showStatusModal = false;
            return;
        }

        $this->circle->update(['status' => $this->targetStatus]);
        session()->flash('message', 'Circle status changed to ' . $this->targetStatus . '.');
        $this->showStatusModal = false;
        $this->refreshCircle();
    }

    /* ── Helpers ──────────────────────────── */

    private function refreshCircle()
    {
        $this->circle = Circle::withCount('members')->findOrFail($this->circleId);
    }

    public function render()
    {
        $members = $this->circle->members()
            ->withPivot('joined_at')
            ->orderBy('circle_members.joined_at', 'desc')
            ->paginate(20);

        return view('livewire.village-banking.circles.circle-members', compact(
            'members',
        ))->layout('layouts.main.master-livewire');
    }
}
