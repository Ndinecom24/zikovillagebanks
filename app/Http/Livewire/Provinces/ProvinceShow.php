<?php

namespace App\Http\Livewire\Provinces;

use App\Models\Province;
use App\Models\Districts;
use App\Models\ConnectionPoints;
use App\Models\IndependentProducer;
use Livewire\Component;

class ProvinceShow extends Component
{
    public $provinceId;
    public $selectedDistrictId = null;

    /* ── District CRUD ──────────────── */
    public $showDistrictModal = false;
    public $districtName = '';
    public $editDistrictId = null;
    public $editDistrictName = '';
    public $deleteDistrictId = null;
    public $deleteDistrictName = '';

    /* ── Substation CRUD ────────────── */
    public $showSubstationModal = false;
    public $substation = '';
    public $voltage_level = '';
    public $coordinates = '';
    public $layout = '';
    public $installed_capacity = '';
    public $substation_capacity = '';

    // Edit substation
    public $editSubId = null;
    public $editSubstation = '';
    public $editVoltage = '';
    public $editCoordinates = '';
    public $editLayout = '';
    public $editInstalledCapacity = '';
    public $editSubstationCapacity = '';

    // Delete substation
    public $deleteSubId = null;
    public $deleteSubName = '';

    /* ── Mount ──────────────────────── */

    public function mount($id, $district = 0)
    {
        $this->provinceId = $id;
        $this->selectedDistrictId = $district > 0 ? $district : null;

        // If no district selected, try to select first one
        if (!$this->selectedDistrictId) {
            $province = Province::with('districts')->find($id);
            if ($province && $province->districts->count() > 0) {
                $this->selectedDistrictId = $province->districts->first()->id;
            }
        }
    }

    /* ── District Selection ─────────── */

    public function selectDistrict($id)
    {
        $this->selectedDistrictId = $id;
        $this->resetSubstationEdit();
    }

    /* ── District Create ────────────── */

    public function openDistrictModal()
    {
        $this->resetValidation();
        $this->districtName = '';
        $this->showDistrictModal = true;
    }

    public function createDistrict()
    {
        $this->validate([
            'districtName' => 'required|string|max:255',
        ], [
            'districtName.required' => 'District name is required.',
        ]);

        Districts::create([
            'province_id' => $this->provinceId,
            'district' => strtoupper(trim($this->districtName)),
        ]);

        $this->showDistrictModal = false;
        $this->districtName = '';
        session()->flash('message', 'District added successfully.');
    }

    /* ── District Inline Edit ───────── */

    public function startEditDistrict($id)
    {
        $d = Districts::findOrFail($id);
        $this->editDistrictId = $d->id;
        $this->editDistrictName = $d->district;
        $this->resetValidation();
    }

    public function saveEditDistrict()
    {
        $this->validate([
            'editDistrictName' => 'required|string|max:255',
        ]);

        Districts::findOrFail($this->editDistrictId)->update([
            'district' => strtoupper(trim($this->editDistrictName)),
        ]);

        $this->editDistrictId = null;
        $this->editDistrictName = '';
        session()->flash('message', 'District updated successfully.');
    }

    public function cancelEditDistrict()
    {
        $this->editDistrictId = null;
        $this->editDistrictName = '';
        $this->resetValidation();
    }

    /* ── District Delete ────────────── */

    public function confirmDeleteDistrict($id)
    {
        $d = Districts::findOrFail($id);
        $this->deleteDistrictId = $d->id;
        $this->deleteDistrictName = $d->district;
    }

    public function deleteDistrict()
    {
        // Delete associated connection points first
        ConnectionPoints::where('district_id', $this->deleteDistrictId)->delete();
        Districts::findOrFail($this->deleteDistrictId)->delete();

        if ($this->selectedDistrictId == $this->deleteDistrictId) {
            $this->selectedDistrictId = null;
        }

        $this->deleteDistrictId = null;
        $this->deleteDistrictName = '';
        session()->flash('message', 'District and its substations deleted successfully.');
    }

    public function cancelDeleteDistrict()
    {
        $this->deleteDistrictId = null;
        $this->deleteDistrictName = '';
    }

    /* ── Substation Create ──────────── */

    public function openSubstationModal()
    {
        $this->resetValidation();
        $this->substation = '';
        $this->voltage_level = '';
        $this->coordinates = '';
        $this->layout = '';
        $this->installed_capacity = '';
        $this->substation_capacity = '';
        $this->showSubstationModal = true;
    }

    public function createSubstation()
    {
        $this->validate([
            'substation' => 'required|string|max:255',
        ], [
            'substation.required' => 'Substation name is required.',
        ]);

        ConnectionPoints::create([
            'district_id' => $this->selectedDistrictId,
            'substation' => trim($this->substation),
            'voltage_level' => $this->voltage_level,
            'coordinates' => $this->coordinates,
            'layout' => $this->layout,
            'installed_capacity' => $this->installed_capacity,
            'substation_capacity' => $this->substation_capacity,
        ]);

        $this->showSubstationModal = false;
        $this->resetSubstationForm();
        session()->flash('message', 'Substation added successfully.');
    }

    private function resetSubstationForm()
    {
        $this->substation = '';
        $this->voltage_level = '';
        $this->coordinates = '';
        $this->layout = '';
        $this->installed_capacity = '';
        $this->substation_capacity = '';
    }

    /* ── Substation Inline Edit ─────── */

    public function startEditSubstation($id)
    {
        $cp = ConnectionPoints::findOrFail($id);
        $this->editSubId = $cp->id;
        $this->editSubstation = $cp->substation;
        $this->editVoltage = $cp->voltage_level;
        $this->editCoordinates = $cp->coordinates;
        $this->editLayout = $cp->layout;
        $this->editInstalledCapacity = $cp->installed_capacity;
        $this->editSubstationCapacity = $cp->substation_capacity;
        $this->resetValidation();
    }

    public function saveEditSubstation()
    {
        $this->validate([
            'editSubstation' => 'required|string|max:255',
        ]);

        ConnectionPoints::findOrFail($this->editSubId)->update([
            'substation' => trim($this->editSubstation),
            'voltage_level' => $this->editVoltage,
            'coordinates' => $this->editCoordinates,
            'layout' => $this->editLayout,
            'installed_capacity' => $this->editInstalledCapacity,
            'substation_capacity' => $this->editSubstationCapacity,
        ]);

        $this->resetSubstationEdit();
        session()->flash('message', 'Substation updated successfully.');
    }

    public function cancelEditSubstation()
    {
        $this->resetSubstationEdit();
        $this->resetValidation();
    }

    private function resetSubstationEdit()
    {
        $this->editSubId = null;
        $this->editSubstation = '';
        $this->editVoltage = '';
        $this->editCoordinates = '';
        $this->editLayout = '';
        $this->editInstalledCapacity = '';
        $this->editSubstationCapacity = '';
    }

    /* ── Substation Delete ──────────── */

    public function confirmDeleteSubstation($id)
    {
        $cp = ConnectionPoints::findOrFail($id);
        $this->deleteSubId = $cp->id;
        $this->deleteSubName = $cp->substation;
    }

    public function deleteSubstation()
    {
        ConnectionPoints::findOrFail($this->deleteSubId)->delete();
        $this->deleteSubId = null;
        $this->deleteSubName = '';
        session()->flash('message', 'Substation deleted successfully.');
    }

    public function cancelDeleteSubstation()
    {
        $this->deleteSubId = null;
        $this->deleteSubName = '';
    }

    /* ── Render ─────────────────────── */

    public function render()
    {
        $province = Province::with('districts.connectionPoint')->findOrFail($this->provinceId);

        $connectionPoints = collect();
        $selectedDistrict = null;
        if ($this->selectedDistrictId) {
            $selectedDistrict = Districts::find($this->selectedDistrictId);
            $connectionPoints = ConnectionPoints::where('district_id', $this->selectedDistrictId)
                ->orderBy('substation')
                ->get();
        }

        $ippCount = IndependentProducer::where('province_id', $this->provinceId)->count();

        return view('livewire.provinces.province-show', [
            'province' => $province,
            'connectionPoints' => $connectionPoints,
            'selectedDistrict' => $selectedDistrict,
            'ippCount' => $ippCount,
        ])->layout('layouts.main.master-livewire');
    }
}
