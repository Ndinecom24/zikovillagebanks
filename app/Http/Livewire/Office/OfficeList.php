<?php

namespace App\Http\Livewire\Office;

use App\Models\ResponsibleOffices;
use Livewire\Component;
use Livewire\WithPagination;

class OfficeList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /* ── Search ─────────────────────── */
    public $search = '';

    /* ── Create form ────────────────── */
    public $officeName = '';
    public $officeStatus = 'Active';

    /* ── Edit form ──────────────────── */
    public $editId;
    public $editOfficeName = '';
    public $editOfficeStatus = '';

    /* ── Delete ─────────────────────── */
    public $deleteId;
    public $deleteName = '';

    protected $listeners = ['refreshOffices' => '$refresh'];

    /* ── Validation ─────────────────── */
    protected function createRules()
    {
        return [
            'officeName'   => 'required|string|max:255|unique:responsible_offices,responsible_office',
            'officeStatus' => 'required|string|max:100',
        ];
    }

    protected function editRules()
    {
        return [
            'editOfficeName'   => 'required|string|max:255|unique:responsible_offices,responsible_office,' . $this->editId,
            'editOfficeStatus' => 'required|string|max:100',
        ];
    }

    /* ── Lifecycle ──────────────────── */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* ── CREATE ─────────────────────── */
    public function create()
    {
        $this->validate($this->createRules());

        ResponsibleOffices::create([
            'responsible_office' => strtoupper($this->officeName),
            'office_status'      => $this->officeStatus,
        ]);

        $this->reset(['officeName', 'officeStatus']);
        $this->officeStatus = 'Active';
        $this->emit('closeModal', 'createOfficeModal');
        session()->flash('message', 'Office created successfully.');
    }

    /* ── EDIT ───────────────────────── */
    public function openEdit($id)
    {
        $office = ResponsibleOffices::findOrFail($id);
        $this->editId           = $office->id;
        $this->editOfficeName   = $office->responsible_office;
        $this->editOfficeStatus = $office->office_status;
    }

    public function update()
    {
        $this->validate($this->editRules());

        $office = ResponsibleOffices::findOrFail($this->editId);
        $office->update([
            'responsible_office' => strtoupper($this->editOfficeName),
            'office_status'      => $this->editOfficeStatus,
        ]);

        $this->reset(['editId', 'editOfficeName', 'editOfficeStatus']);
        $this->emit('closeModal', 'editOfficeModal');
        session()->flash('message', 'Office updated successfully.');
    }

    /* ── DELETE ─────────────────────── */
    public function confirmDelete($id)
    {
        $office = ResponsibleOffices::findOrFail($id);
        $this->deleteId   = $office->id;
        $this->deleteName = $office->responsible_office;
    }

    public function delete()
    {
        ResponsibleOffices::findOrFail($this->deleteId)->delete();

        $this->reset(['deleteId', 'deleteName']);
        $this->emit('closeModal', 'deleteOfficeModal');
        session()->flash('message', 'Office deleted successfully.');
    }

    /* ── RENDER ─────────────────────── */
    public function render()
    {
        $offices = ResponsibleOffices::query()
            ->when($this->search, function ($q) {
                $q->where('responsible_office', 'like', '%' . $this->search . '%')
                  ->orWhere('office_status', 'like', '%' . $this->search . '%');
            })
            ->orderBy('responsible_office')
            ->paginate(10);

        return view('livewire.office.office-list', compact('offices'));
    }
}
