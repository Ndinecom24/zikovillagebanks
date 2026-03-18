<?php

namespace App\Http\Livewire\Modules;

use App\Models\Module;
use App\Models\ModuleTasks;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ModuleShow extends Component
{

    public function mount($id)
    {
        $this->module_details = Module::find($id);
        $this->tasks = ModuleTasks::where('module_id', $this->module_details->id )
            ->get();

    }

    public function render()
    {
        return view('livewire.modules.module-show');
    }

    public function createTask()
    {
        $user = Auth::user();

        ModuleTasks::updateOrCreate([
            'task_name' => $this->task_name,
            'task_description' => $this->task_description,
            'office_id' => $this->office_id,
            'module_id' => $this->module_id,
            'created_by' => $user->name,
            'created_by_staff_no' => $user->staff_no ,
        ],
            [

                    'task_name' => $this->task_name,
                    'task_description' => $this->task_description,
                    'office_id' => $this->office_id,
                    'module_id' => $this->module_id,
                    'created_by' => $user->name,
                    'created_by_staff_no' => $user->staff_no ,
            ]);

        $this->resetInputs();
        session()->flash('message', 'Task Created Successfully');
    }

    private function resetInputs()
    {
        $this->task_name = '';
        $this->task_description = '';
        $this->module_name = '';

    }
}
