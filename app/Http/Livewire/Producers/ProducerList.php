<?php

namespace App\Http\Livewire\Producers;

use App\Models\IndependentProducer;
use App\Models\Province;
use App\Models\Districts;
use App\Models\ConnectionPoints;
use App\Models\Status;
use App\Models\Venture;
use App\Models\Technology;
use App\Models\FileUploads;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ProducerList extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    /* ── List / Search / Sort ───────── */
    public $search = '';
    public $perPage = 15;
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $filterStatus = '';
    public $filterProvince = '';
    public $filterTechnology = '';

    /* ── Create Modal ───────────────── */
    public $showCreateModal = false;

    // Form fields
    public $invoiced_services = 'N/A';
    public $engagement_number = '';
    public $technology = '';
    public $name_of_ipp = '';
    public $date_of_application = '';
    public $size_of_plant = '';
    public $size_of_plant_unit = 'MW';
    public $province_id = '';
    public $district_id = '';
    public $proposed_connection_point = '';
    public $total_available_capacity = '';
    public $committed_capacity = '';
    public $available_capacity = '';
    public $voltage_level = '';
    public $ipp_tariff = '';
    public $preferred_connection_level = '';
    public $date_of_connection = '';
    public $expiry_connection_point = '';
    public $status_of_engagement = '';
    public $updates_on_engagements = '';
    public $type_of_venture = '';
    public $contact_person_name = '';
    public $contact_person_email = '';
    public $contact_person_phone = '';
    public $doc_files = [];

    // Cascading selects data
    public $districts = [];
    public $connectionPoints = [];

    /* ── Delete ─────────────────────── */
    public $deleteId = null;
    public $deleteName = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 15],
        'filterStatus' => ['except' => ''],
        'filterProvince' => ['except' => ''],
        'filterTechnology' => ['except' => ''],
    ];

    protected function rules()
    {
        return [
            'name_of_ipp' => 'required|string|max:255',
            'engagement_number' => 'required|string',
            'province_id' => 'required',
            'contact_person_name' => 'nullable|string|max:255',
            'contact_person_email' => 'nullable|email|max:255',
            'contact_person_phone' => 'nullable|string|max:50',
            'size_of_plant' => 'nullable|numeric|min:0',
            'date_of_application' => 'nullable|date',
            'date_of_connection' => 'nullable|date',
            'expiry_connection_point' => 'nullable|date',
        ];
    }

    protected $messages = [
        'name_of_ipp.required' => 'IPP name is required.',
        'engagement_number.required' => 'Technology / engagement type is required.',
        'province_id.required' => 'Province is required.',
    ];

    /* ── Lifecycle ──────────────────── */

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatingFilterProvince()
    {
        $this->resetPage();
    }

    public function updatingFilterTechnology()
    {
        $this->resetPage();
    }

    /* ── Province → District → Connection Point Cascading ── */

    public function updatedProvinceId($value)
    {
        $this->district_id = '';
        $this->proposed_connection_point = '';
        $this->voltage_level = '';
        $this->connectionPoints = [];

        if ($value) {
            $this->districts = Districts::where('province_id', $value)->get()->toArray();
        } else {
            $this->districts = [];
        }
    }

    public function updatedDistrictId($value)
    {
        $this->proposed_connection_point = '';
        $this->voltage_level = '';

        if ($value) {
            $this->connectionPoints = ConnectionPoints::where('district_id', $value)->get()->toArray();
        } else {
            $this->connectionPoints = [];
        }
    }

    public function updatedProposedConnectionPoint($value)
    {
        // Auto-fill voltage level from connection point
        if ($value) {
            $cp = ConnectionPoints::where('substation', $value)->first();
            if ($cp) {
                $this->voltage_level = $cp->voltage_level ?? '';
            }
        }
    }

    public function updatedTotalAvailableCapacity()
    {
        $this->computeAvailableCapacity();
    }

    public function updatedCommittedCapacity()
    {
        $this->computeAvailableCapacity();
    }

    private function computeAvailableCapacity()
    {
        $total = is_numeric($this->total_available_capacity) ? (float) $this->total_available_capacity : 0;
        $committed = is_numeric($this->committed_capacity) ? (float) $this->committed_capacity : 0;
        $this->available_capacity = $total - $committed;
    }

    /* ── Sorting ────────────────────── */

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /* ── Create ─────────────────────── */

    public function openCreateModal()
    {
        $this->resetValidation();
        $this->resetCreateForm();
        $this->showCreateModal = true;
    }

    private function resetCreateForm()
    {
        $this->invoiced_services = 'N/A';
        $this->engagement_number = '';
        $this->technology = '';
        $this->name_of_ipp = '';
        $this->date_of_application = '';
        $this->size_of_plant = '';
        $this->size_of_plant_unit = 'MW';
        $this->province_id = '';
        $this->district_id = '';
        $this->proposed_connection_point = '';
        $this->total_available_capacity = '';
        $this->committed_capacity = '';
        $this->available_capacity = '';
        $this->voltage_level = '';
        $this->ipp_tariff = '';
        $this->preferred_connection_level = '';
        $this->date_of_connection = '';
        $this->expiry_connection_point = '';
        $this->status_of_engagement = '';
        $this->updates_on_engagements = '';
        $this->type_of_venture = '';
        $this->contact_person_name = '';
        $this->contact_person_email = '';
        $this->contact_person_phone = '';
        $this->doc_files = [];
        $this->districts = [];
        $this->connectionPoints = [];
    }

    public function createProducer()
    {
        $this->validate();

        $tech = substr($this->engagement_number, 0, 3);
        $date = Carbon::now();
        $docCount = 'RE/IPP/' . $tech . '/' . $date->month . $date->year . '00000' . IndependentProducer::count('id');

        $ipp = IndependentProducer::create([
            'system_ref' => $docCount,
            'invoiced_services' => $this->invoiced_services,
            'technology' => $this->technology ?: $this->engagement_number,
            'engagement_number' => $this->engagement_number,
            'name_of_ipp' => $this->name_of_ipp,
            'date_of_application' => $this->date_of_application ?: null,
            'size_of_plant' => $this->size_of_plant ?: null,
            'size_of_plant_unit' => $this->size_of_plant_unit,
            'province_id' => $this->province_id ?: null,
            'district_id' => $this->district_id ?: null,
            'proposed_connection_point' => $this->proposed_connection_point,
            'available_capacity' => $this->available_capacity ?: null,
            'voltage_level' => $this->voltage_level,
            'date_of_connection' => $this->date_of_connection ?: null,
            'expiry_connection_point' => $this->expiry_connection_point ?: null,
            'status_of_engagement' => $this->status_of_engagement,
            'updates_on_engagements' => $this->updates_on_engagements,
            'date_of_update' => now(),
            'updated_by' => auth()->user()->name ?? 'System',
            'type_of_venture' => $this->type_of_venture ?: null,
            'contact_person_name' => $this->contact_person_name,
            'contact_person_email' => $this->contact_person_email,
            'contact_person_phone' => $this->contact_person_phone,
            'preferred_connection_level' => $this->preferred_connection_level,
            'ipp_tariff' => $this->ipp_tariff,
        ]);

        // Handle file uploads
        if (!empty($this->doc_files)) {
            foreach ($this->doc_files as $file) {
                $originalName = $file->getClientOriginalName();
                $safeBase = preg_replace("/[^a-zA-Z0-9_\-]/", "_", pathinfo($originalName, PATHINFO_FILENAME));
                $extension = $file->getClientOriginalExtension();
                $fileName = $safeBase . '_' . time() . '_' . Str::random(4) . '.' . $extension;
                $size = number_format($file->getSize() / 1048576, 2);
                $path = $file->storeAs('public/contracts', $fileName);

                FileUploads::create([
                    'uuid' => Str::uuid()->toString(),
                    'name' => $fileName,
                    'original_name' => $originalName,
                    'size' => $size,
                    'path' => $path,
                    'ext' => strtolower($extension),
                    'mime_type' => $file->getMimeType(),
                    'folder' => 'contracts',
                    'model_id' => $ipp->id,
                    'modal_code' => $ipp->system_ref,
                    'model_code' => $ipp->system_ref,
                    'type' => 'contracts',
                    'uploaded_by' => auth()->id(),
                ]);
            }
        }

        $this->showCreateModal = false;
        $this->resetCreateForm();
        session()->flash('message', 'IPP "' . $ipp->name_of_ipp . '" created successfully.');
    }

    /* ── Delete ─────────────────────── */

    public function confirmDelete($id)
    {
        $ipp = IndependentProducer::findOrFail($id);
        $this->deleteId = $ipp->id;
        $this->deleteName = $ipp->name_of_ipp ?? ('IPP #' . $ipp->id);
    }

    public function deleteProducer()
    {
        IndependentProducer::findOrFail($this->deleteId)->delete();
        $this->deleteId = null;
        $this->deleteName = '';
        session()->flash('message', 'IPP deleted successfully.');
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    /* ── Render ─────────────────────── */

    public function render()
    {
        $producers = IndependentProducer::query()
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('name_of_ipp', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('system_ref', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('engagement_number', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('contact_person_name', 'LIKE', '%' . $this->search . '%')
                        ->orWhere('technology', 'LIKE', '%' . $this->search . '%');
                });
            })
            ->when($this->filterStatus, function ($q) {
                $q->where('status_of_engagement', $this->filterStatus);
            })
            ->when($this->filterProvince, function ($q) {
                $q->where('province_id', $this->filterProvince);
            })
            ->when($this->filterTechnology, function ($q) {
                $q->where('engagement_number', $this->filterTechnology);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $provinces = Province::orderBy('province')->get();
        $statuses = Status::orderBy('status')->get();
        $ventures = Venture::orderBy('venture_type')->get();
        $technologies = Technology::orderBy('technology_name')->get();

        return view('livewire.producers.producer-list', [
            'producers' => $producers,
            'provinces' => $provinces,
            'statuses' => $statuses,
            'ventures' => $ventures,
            'technologies' => $technologies,
        ])->layout('layouts.main.master-livewire');
    }
}
