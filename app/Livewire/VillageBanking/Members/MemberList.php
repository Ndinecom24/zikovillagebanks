<?php

namespace App\Livewire\VillageBanking\Members;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Layout('layouts.main.master-livewire')]
class MemberList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url]
    public $search = '';
    #[Url]
    public $statusFilter = '';
    public $perPage = 15;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Delete
    public $deleteId;
    public $deleteName;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function confirmDelete($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->deleteId = $id;
            $this->deleteName = $user->name;
        }
    }

    public function deleteMember()
    {
        $user = User::find($this->deleteId);
        if ($user) {
            $user->delete();
            session()->flash('message', 'Member removed successfully.');
        }
        $this->reset(['deleteId', 'deleteName']);
    }

    public function render()
    {
        $query = User::with(['guarantor', 'roles'])
            ->withCount('circles');

        // Status filter
        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        // Search
        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('email', 'like', $term)
                  ->orWhere('phone', 'like', $term)
                  ->orWhere('username', 'like', $term);
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $members = $query->paginate($this->perPage);

        // Stats
        $totalMembers   = User::count();
        $activeMembers  = User::where('status', 'active')->count();
        $pendingMembers = User::where('status', 'pending')->count();

        return view('livewire.village-banking.members.member-list', compact(
            'members',
            'totalMembers',
            'activeMembers',
            'pendingMembers',
        ));
    }
}
