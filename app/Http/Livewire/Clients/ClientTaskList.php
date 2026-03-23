<?php

namespace App\Http\Livewire\Clients;

use App\Models\ClientDetails;
use App\Models\ClientProcess;
use App\Models\ClientTaskProgress;
use App\Models\Process;
use App\Models\ProcessModule;
use App\Models\ResponsibleOffices;
use Livewire\Component;
use Livewire\WithPagination;

class ClientTaskList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /* ── Filters ──────────────────────── */
    public $search = '';
    public $filterStatus = '';
    public $filterClient = '';
    public $filterProcess = '';
    public $filterModule = '';
    public $filterOffice = '';
    public $filterPriority = '';
    public $perPage = 20;

    protected $queryString = [
        'search'         => ['except' => ''],
        'filterStatus'   => ['except' => ''],
        'filterClient'   => ['except' => ''],
        'filterProcess'  => ['except' => ''],
        'filterModule'   => ['except' => ''],
        'filterOffice'   => ['except' => ''],
        'filterPriority' => ['except' => ''],
        'perPage'        => ['except' => 20],
    ];

    /* ── Reset page on filter changes ── */
    public function updatingSearch()         { $this->resetPage(); }
    public function updatingFilterStatus()   { $this->resetPage(); }
    public function updatingFilterClient()   { $this->resetPage(); }
    public function updatingFilterProcess()  { $this->resetPage(); }
    public function updatingFilterModule()   { $this->resetPage(); }
    public function updatingFilterOffice()   { $this->resetPage(); }
    public function updatingFilterPriority() { $this->resetPage(); }

    public function clearFilters()
    {
        $this->reset([
            'search', 'filterStatus', 'filterClient', 'filterProcess',
            'filterModule', 'filterOffice', 'filterPriority',
        ]);
        $this->resetPage();
    }

    /* ── Stats for header ──────────────── */
    public function getStatsProperty()
    {
        $base = ClientTaskProgress::query();
        return [
            'total'       => (clone $base)->count(),
            'pending'     => (clone $base)->where('status', 'pending')->count(),
            'in_progress' => (clone $base)->where('status', 'in_progress')->count(),
            'completed'   => (clone $base)->where('status', 'completed')->count(),
        ];
    }

    /* ── Dropdown data ────────────────── */
    public function getClientsProperty()
    {
        return ClientDetails::select('id', 'company_name')
            ->whereHas('clientProcesses')
            ->orderBy('company_name')
            ->get();
    }

    public function getProcessesProperty()
    {
        return Process::select('id', 'name')
            ->whereHas('clientProcesses')
            ->orderBy('name')
            ->get();
    }

    public function getModulesProperty()
    {
        $query = ProcessModule::select('id', 'name', 'process_id')->orderBy('order');
        if ($this->filterProcess) {
            $query->where('process_id', $this->filterProcess);
        }
        return $query->get();
    }

    public function getOfficesProperty()
    {
        return ResponsibleOffices::select('id', 'responsible_office')
            ->orderBy('responsible_office')
            ->get();
    }

    public function render()
    {
        $query = ClientTaskProgress::query()
            ->with([
                'clientProcess.client',
                'clientProcess.process',
                'processTask.module',
                'processTask.offices',
                'completedByUser',
            ]);

        // Search by task title or client company name
        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('processTask', function ($sub) use ($search) {
                    $sub->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                })->orWhereHas('clientProcess.client', function ($sub) use ($search) {
                    $sub->where('company_name', 'like', "%{$search}%");
                });
            });
        }

        // Status filter
        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        // Client filter
        if ($this->filterClient) {
            $query->whereHas('clientProcess', function ($q) {
                $q->where('client_id', $this->filterClient);
            });
        }

        // Process filter
        if ($this->filterProcess) {
            $query->whereHas('clientProcess', function ($q) {
                $q->where('process_id', $this->filterProcess);
            });
        }

        // Module filter
        if ($this->filterModule) {
            $query->whereHas('processTask', function ($q) {
                $q->where('module_id', $this->filterModule);
            });
        }

        // Office filter
        if ($this->filterOffice) {
            $query->whereHas('processTask.offices', function ($q) {
                $q->where('responsible_offices.id', $this->filterOffice);
            });
        }

        // Priority filter
        if ($this->filterPriority) {
            $query->whereHas('processTask', function ($q) {
                $q->where('priority', $this->filterPriority);
            });
        }

        $tasks = $query->orderByRaw("
            CASE status
                WHEN 'in_progress' THEN 1
                WHEN 'pending' THEN 2
                WHEN 'skipped' THEN 3
                WHEN 'completed' THEN 4
                ELSE 5
            END
        ")->orderBy('updated_at', 'desc')
          ->paginate($this->perPage);

        return view('livewire.clients.client-task-list', [
            'tasks' => $tasks,
        ]);
    }
}
