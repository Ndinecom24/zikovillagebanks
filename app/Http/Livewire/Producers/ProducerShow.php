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
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProducerShow extends Component
{
    use WithFileUploads;

    public $producerId;
    public $editing = false;

    /* ── Form fields ────────────────── */
    public $system_ref;
    public $invoiced_services;
    public $engagement_number;
    public $technology;
    public $name_of_ipp;
    public $date_of_application;
    public $size_of_plant;
    public $size_of_plant_unit;
    public $province_id;
    public $district_id;
    public $proposed_connection_point;
    public $available_capacity;
    public $voltage_level;
    public $ipp_tariff;
    public $preferred_connection_level;
    public $date_of_connection;
    public $expiry_connection_point;
    public $status_of_engagement;
    public $updates_on_engagements;
    public $date_of_update;
    public $updated_by;
    public $type_of_venture;
    public $contact_person_name;
    public $contact_person_email;
    public $contact_person_phone;
    public $expected_date_commissioning;
    public $expected_commercial;

    /* ── Cascading data ─────────────── */
    public $districts = [];
    public $connectionPoints = [];

    /* ── File upload ────────────────── */
    public $newFiles = [];
    public $contracts = [];

    protected function rules()
    {
        return [
            'name_of_ipp' => 'required|string|max:255',
            'engagement_number' => 'required|string',
            'province_id' => 'required',
            'contact_person_email' => 'nullable|email|max:255',
            'size_of_plant' => 'nullable|numeric|min:0',
        ];
    }

    /* ── Mount ──────────────────────── */

    public function mount($id)
    {
        $this->producerId = $id;
        $this->loadProducer();
    }

    private function loadProducer()
    {
        $item = IndependentProducer::findOrFail($this->producerId);

        $this->system_ref = $item->system_ref;
        $this->invoiced_services = $item->invoiced_services;
        $this->engagement_number = $item->engagement_number;
        $this->technology = $item->technology;
        $this->name_of_ipp = $item->name_of_ipp;
        $this->date_of_application = $item->date_of_application ? $item->date_of_application->format('Y-m-d') : '';
        $this->size_of_plant = $item->size_of_plant;
        $this->size_of_plant_unit = $item->size_of_plant_unit ?? 'MW';
        $this->province_id = $item->province_id;
        $this->district_id = $item->district_id;
        $this->proposed_connection_point = $item->proposed_connection_point;
        $this->available_capacity = $item->available_capacity;
        $this->voltage_level = $item->voltage_level;
        $this->ipp_tariff = $item->ipp_tariff;
        $this->preferred_connection_level = $item->preferred_connection_level;
        $this->date_of_connection = $item->date_of_connection ? $item->date_of_connection->format('Y-m-d') : '';
        $this->expiry_connection_point = $item->expiry_connection_point;
        $this->status_of_engagement = $item->status_of_engagement;
        $this->updates_on_engagements = $item->updates_on_engagements;
        $this->date_of_update = $item->date_of_update ? $item->date_of_update->format('Y-m-d') : '';
        $this->updated_by = $item->updated_by;
        $this->type_of_venture = $item->type_of_venture;
        $this->contact_person_name = $item->contact_person_name;
        $this->contact_person_email = $item->contact_person_email;
        $this->contact_person_phone = $item->contact_person_phone;
        $this->expected_date_commissioning = $item->expected_date_commissioning ? $item->expected_date_commissioning->format('Y-m-d') : '';
        $this->expected_commercial = $item->expected_commercial;

        // Load cascading selects
        if ($this->province_id) {
            $this->districts = Districts::where('province_id', $this->province_id)->get()->toArray();
        }
        if ($this->district_id) {
            $this->connectionPoints = ConnectionPoints::where('district_id', $this->district_id)->get()->toArray();
        }

        // Load contracts
        $this->contracts = FileUploads::where('type', 'contracts')
            ->where('model_id', $item->id)
            ->orderByDesc('created_at')
            ->get();
    }

    /* ── Cascading Selects ──────────── */

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
        if ($value) {
            $cp = ConnectionPoints::where('substation', $value)->first();
            if ($cp) {
                $this->voltage_level = $cp->voltage_level ?? '';
            }
        }
    }

    /* ── Edit Toggle ────────────────── */

    public function startEditing()
    {
        $this->editing = true;
        $this->resetValidation();
    }

    public function cancelEditing()
    {
        $this->editing = false;
        $this->loadProducer();
        $this->resetValidation();
    }

    public function saveProducer()
    {
        $this->validate();

        $item = IndependentProducer::findOrFail($this->producerId);
        $item->update([
            'invoiced_services' => $this->invoiced_services,
            'engagement_number' => $this->engagement_number,
            'technology' => $this->technology ?: $this->engagement_number,
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
            'expected_date_commissioning' => $this->expected_date_commissioning ?: null,
            'expected_commercial' => $this->expected_commercial,
        ]);

        // Handle new file uploads
        if (!empty($this->newFiles)) {
            foreach ($this->newFiles as $file) {
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
                    'model_id' => $item->id,
                    'modal_code' => $item->system_ref,
                    'model_code' => $item->system_ref,
                    'type' => 'contracts',
                    'uploaded_by' => auth()->id(),
                ]);
            }
            $this->newFiles = [];
        }

        $this->editing = false;
        $this->loadProducer();
        session()->flash('message', 'IPP updated successfully.');
    }

    /* ── Delete File ────────────────── */

    public function deleteFile($fileId)
    {
        $file = FileUploads::findOrFail($fileId);
        // Delete physical file
        $storagePath = storage_path('app/' . $file->path);
        if (file_exists($storagePath)) {
            unlink($storagePath);
        }
        $file->delete();
        $this->loadProducer();
        session()->flash('message', 'File deleted successfully.');
    }

    /* ── Render ─────────────────────── */

    public function render()
    {
        $item = IndependentProducer::with(['province', 'districts', 'ventures'])->findOrFail($this->producerId);
        $provinces = Province::orderBy('province')->get();
        $statuses = Status::orderBy('status')->get();
        $ventures = Venture::orderBy('venture_type')->get();
        $technologies = Technology::orderBy('technology_name')->get();

        return view('livewire.producers.producer-show', [
            'item' => $item,
            'provinces' => $provinces,
            'statuses' => $statuses,
            'ventures' => $ventures,
            'technologies' => $technologies,
        ])->layout('layouts.main.master-livewire');
    }
}
