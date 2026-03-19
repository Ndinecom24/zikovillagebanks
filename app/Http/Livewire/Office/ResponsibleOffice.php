<?php

namespace App\Http\Livewire\Office;

use App\Models\ResponsibleOffices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ResponsibleOffice extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $offices;
    public $office_status, $responsible_office;

    public function mount()
    {
        $this->offices = ResponsibleOffices::get();
    }
    public function create()
    {

        ResponsibleOffices::updateOrCreate([
            'responsible_office' => strtoupper($this->responsible_office),
            'office_status' => $this->office_status,
        ],
            [
                'responsible_office' => strtoupper($this->responsible_office),
                'office_status' => $this->office_status,
            ]);

        $this->resetInputs();
        session()->flash('message', 'Created Successfully');

    }
    private function resetInputs()
    {
        $this->responsible_office = '';

    }

    public function render()
    {
        return view('livewire.office.responsible-office');
    }
}
