<?php

namespace App\Livewire\VillageBanking\Circles;

use App\Models\VillageBanking\Circle;
use App\Traits\HasVillageBankScope;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Layout('layouts.main.master-livewire')]
class CircleList extends Component
{
    use WithPagination, HasVillageBankScope;

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
        $circle = Circle::find($id);
        if ($circle) {
            $this->deleteId = $id;
            $this->deleteName = $circle->name;
        }
    }

    public function deleteCircle()
    {
        $circle = Circle::find($this->deleteId);
        if ($circle) {
            $circle->delete();
            session()->flash('message', 'Circle deleted successfully.');
        }
        $this->reset(['deleteId', 'deleteName']);
    }

    public function render()
    {
        $query = $this->scopedCircleQuery()
            ->with('creator')
            ->withCount('members');

        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhereHas('creator', fn ($c) => $c->where('name', 'like', $term));
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $circles = $query->paginate($this->perPage);

        // Stats (scoped to selected village bank)
        $baseQuery     = $this->scopedCircleQuery();
        $totalCircles  = (clone $baseQuery)->count();
        $draftCircles  = (clone $baseQuery)->where('status', 'draft')->count();
        $activeCircles = (clone $baseQuery)->where('status', 'active')->count();
        $completedCircles = (clone $baseQuery)->where('status', 'completed')->count();

        return view('livewire.village-banking.circles.circle-list', compact(
            'circles',
            'totalCircles',
            'draftCircles',
            'activeCircles',
            'completedCircles',
        ));
    }
}
