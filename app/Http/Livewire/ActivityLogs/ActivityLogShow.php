<?php

namespace App\Http\Livewire\ActivityLogs;

use App\Models\ActivityLog;
use Livewire\Component;

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
        return view('livewire.activity-logs.activity-log-show')
            ->layout('layouts.main.master-livewire');
    }
}
