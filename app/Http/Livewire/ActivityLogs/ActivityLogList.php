<?php

namespace App\Http\Livewire\ActivityLogs;

use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityLogList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $filterType = '';      // auth, model, system
    public $filterEvent = '';     // login, logout, created, updated, deleted
    public $filterDateFrom = '';
    public $filterDateTo = '';
    public $perPage = 25;

    // Detail modal
    public $showDetail = false;
    public $detailLog = null;

    protected $queryString = [
        'search'     => ['except' => ''],
        'filterType' => ['except' => ''],
        'filterEvent'=> ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function updatingFilterEvent()
    {
        $this->resetPage();
    }

    public function viewDetail($id)
    {
        $this->detailLog = ActivityLog::with('user')->find($id);
        $this->showDetail = true;
    }

    public function closeDetail()
    {
        $this->showDetail = false;
        $this->detailLog = null;
    }

    public function clearFilters()
    {
        $this->reset(['search', 'filterType', 'filterEvent', 'filterDateFrom', 'filterDateTo']);
        $this->resetPage();
    }

    public function render()
    {
        $logs = ActivityLog::with('user')
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('description', 'like', '%' . $this->search . '%')
                       ->orWhere('user_name', 'like', '%' . $this->search . '%')
                       ->orWhere('ip_address', 'like', '%' . $this->search . '%')
                       ->orWhere('subject_type', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterType, fn($q) => $q->where('log_type', $this->filterType))
            ->when($this->filterEvent, fn($q) => $q->where('event', $this->filterEvent))
            ->when($this->filterDateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->filterDateFrom))
            ->when($this->filterDateTo, fn($q) => $q->whereDate('created_at', '<=', $this->filterDateTo))
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        // Stats
        $stats = [
            'total'   => ActivityLog::count(),
            'today'   => ActivityLog::whereDate('created_at', today())->count(),
            'logins'  => ActivityLog::where('event', 'login')->whereDate('created_at', today())->count(),
            'changes' => ActivityLog::whereIn('event', ['created', 'updated', 'deleted'])->whereDate('created_at', today())->count(),
        ];

        return view('livewire.activity-logs.activity-log-list', [
            'logs'  => $logs,
            'stats' => $stats,
        ])->layout('layouts.main.master-livewire');
    }
}
