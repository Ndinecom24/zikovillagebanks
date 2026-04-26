<?php

namespace App\Livewire\VillageBanking\Circles;

use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankConfiguration;
use App\Notifications\CircleCreatedNotification;
use App\Services\LicenseEnforcement;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class CircleCreate extends Component
{
    use HasVillageBankScope;
    public $name = '';
    public $durationMonths = 12;
    public $startDate = '';

    public $successMessage = '';
    public $circleLimitReached = false;
    public $circleLimitMessage = '';

    public function mount( )
    {
        $this->loadDurationFromConfig();
        $this->checkCircleLimit();
    }

    protected function checkCircleLimit()
    {
        $bankId = $this->activeBankId();
        if (!empty($bankId)) {
            $check = LicenseEnforcement::forBank($bankId)->canAddCircles();
            $this->circleLimitReached = !$check['allowed'];
            $this->circleLimitMessage = $check['message'];
        }
    }

    public function updatedVillageBankId()
    {
        $this->loadDurationFromConfig();
    }

    protected function loadDurationFromConfig()
    {
        $bankId = $this->activeBankId();
        if (!empty($bankId)) {
            $config = VillageBankConfiguration::forBank($bankId);
            $this->durationMonths = $config->circle_duration_months;
        }
    }

    protected function rules()
    {
        return [
            'villageBankId'  => 'required|exists:village_banks,id',
            'name'           => 'required|string|max:255|unique:circles,name',
            'durationMonths' => 'required|integer|min:1|max:60',
            'startDate'      => 'required|date|after_or_equal:today',
        ];
    }

    protected $messages = [
        'villageBankId.required'  => 'Select a village bank.',
        'name.required'           => 'Circle name is required.',
        'name.unique'             => 'A circle with this name already exists.',
        'durationMonths.required' => 'Duration is required.',
        'durationMonths.min'      => 'Duration must be at least 1 month.',
        'startDate.required'      => 'Start date is required.',
        'startDate.after_or_equal'=> 'Start date must be today or later.',
    ];

    public function getEndDateProperty()
    {
        if (empty($this->startDate) || empty($this->durationMonths)) {
            return null;
        }
        try {
            return \Carbon\Carbon::parse($this->startDate)
                ->addMonths((int) $this->durationMonths)
                ->subDay()
                ->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    public function createCircle()
    {
        // Enforce circle limit before creating
        $bankId = $this->activeBankId();
        if (!empty($bankId)) {
            $check = LicenseEnforcement::forBank($bankId)->canAddCircles();
            if (!$check['allowed']) {
                $this->circleLimitReached = true;
                $this->circleLimitMessage = $check['message'];
                session()->flash('error', $check['message']);
                return;
            }
        }

        $this->validate();

        try {
            $circle = Circle::create([
                'village_bank_id' => $this->villageBankId,
                'name'            => $this->name,
                'duration_months' => $this->durationMonths,
                'start_date'      => $this->startDate,
                'end_date'        => $this->endDate,
                'status'          => 'draft',
                'created_by'      => Auth::id(),
            ]);

            // Notify all village bank members (email + SMS)
            $villageBank = VillageBank::with('members')->find($this->villageBankId);
            if ($villageBank) {
                foreach ($villageBank->members as $member) {
                    $member->notify(new CircleCreatedNotification($circle, $villageBank));
                }
            }

            $this->resetForm();
            $this->successMessage = 'Circle created successfully! It is now in draft status.';
        } catch (\Exception $e) {
            $this->addError('name', 'Failed to create circle. Please try again.');
        }
    }

    public function resetForm()
    {
        $this->reset(['name', 'startDate', 'villageBankId']);
        $this->durationMonths = 12;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.village-banking.circles.circle-create', [
            'endDate' => $this->endDate,
        ]);
    }
}
