<?php

namespace App\Http\Livewire\Modules;

use App\Models\Module;
use App\Models\ModuleTasks;
use App\Models\ResponsibleOffices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ModuleShow extends Component
{
    use WithPagination;

    public $module_details, $tasks, $offices;
    public $task_name, $task_description, $office_id, $module_id, $task_id, $module_name, $moduleId;
    protected $paginationTheme = 'bootstrap';

    public function rules()
    {
        return [
            // Validation rules for active energies data
            'task_name' => ['required'],                 // Circuit details are optional
            'office_id' => ['required'],      // Current main meter reading is optional
            'task_description' => ['required'],         // Past main meter reading is optional
            // Advance main meter reading is optional

        ];
    }

    public function mount($id)
    {
        $this->module_details = Module::find($id);
        $this->tasks = ModuleTasks::where('module_id', $this->module_details->id)
            ->get();
        $this->offices = ResponsibleOffices::all();
    }

    public function render()
    {
        return view('livewire.modules.module-show');
    }

    public function createTask()
    {

        $this->validate();
        $user = Auth::user();
        ModuleTasks::updateOrCreate([
            'task_name' => $this->task_name,
            'task_description' => $this->task_description,
            'office_id' => $this->office_id,
            'module_id' => $this->module_details->id,
            'created_by' => $user->name,
            'created_by_staff_no' => $user->staff_no,
        ],
            [

                'task_name' => $this->task_name,
                'task_description' => $this->task_description,
                'office_id' => $this->office_id,
                'module_id' => $this->module_details->id,
                'created_by' => $user->name,
                'created_by_staff_no' => $user->staff_no,
            ]);

        $this->resetInputs();
        session()->flash('message', 'Task Created Successfully');
    }

    private function resetInputs()
    {
        $this->task_name = '';
        $this->task_description = '';
        $this->office_id = '';


    }

    public function editTask($id)
    {
        $task = ModuleTasks::findOrFail($id);
        $this->task_name = $task->task_name;
        $this->task_description = $task->task_description;
        $this->office_id = $task->office_id;
        $this->task_id = $id;
    }

    public function updateTask()
    {
        $user = Auth::user();
        $task = ModuleTasks::findOrFail($this->task_id);
        $task->update([
            'task_name' => $this->task_name,
            'task_description' => $this->task_description,
            'office_id' => $this->office_id,
            'created_by' => $user->name,
            'created_by_staff_no' => $user->staff_no,

        ]);
        session()->flash('message', 'Updated Successfully');
    }

    public function editModule($id)
    {
        $module = Module::findOrFail($id);
        $this->module_name = $module->module_name;

        $this->moduleId = $id;
    }

    public function updateModule()
    {

        $task = Module::findOrFail($this->moduleId);
        $task->update([
            'module_name' => $this->module_name,
        ]);
        session()->flash('message', 'Updated Successfully');
    }
}
