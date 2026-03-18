<?php

namespace App\Http\Livewire\Modules;


use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ModuleList extends Component
{
    public $module_name;
    public $modules;

    public function mount()
    {
        $this->modules = Module::get();
    }

    public function render()
    {
        return view('livewire.modules.module-list');
    }

    public function create()
    {
        $user = Auth::user();

        Module::updateOrCreate([
            'module_name' => strtoupper($this->module_name),
            'created_by' => $user->name,
            'created_by_staff_no' => $user->staff_no ,
        ],
            [
                'module_name' => strtoupper($this->module_name),
                'created_by' => $user->name,
                'created_by_staff_no' => $user->staff_no ,
                ]);

        $this->resetInputs();
        session()->flash('message', 'Created Successfully');

    }
    private function resetInputs()
    {
        $this->module_name = '';

    }
}
