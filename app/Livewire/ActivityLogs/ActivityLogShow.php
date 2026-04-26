<?php

namespace App\Livewire\ActivityLogs;

use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class ActivityLogShow extends Component
{
    public $logId;
    public $log;

    public function mount($id)
    {
        $this->logId = $id;
        $this->log = ActivityLog::with('user')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.activity-logs.activity-log-show');
    }
}
