<?php

namespace App\Http\Livewire\Quotation;

use App\Models\Banks;
use App\Models\ClientDetails;
use App\Models\GisQuotations;
use App\Models\GisQuotationsItems;
use Livewire\Component;

class QuotationShow extends Component
{
    public $quotation, $quotations_items, $client;
    public $selectedBanks;
    public $selectedBankDetails = [];
    public $banks = [];

    public function mount($uuid)
    {
        $this->quotation = GisQuotations::where('uuid', $uuid)->first();
        $this->quotations_items = GisQuotationsItems::where('quotation_id', $this->quotation->id)
            ->get();
        $this->client = ClientDetails::where('id', $this->quotation->client_id)->first();
        $this->banks = Banks::all(); // 👈 ADD THIS

    }

    public function render()
    {

        return view('livewire.quotation.quotation-show');
    }

    public function attachBankDetails()
    {
        if (!$this->selectedBanks) {
            session()->flash('error', 'Please select a bank.');
            return;
        }

        $this->quotation->update([
            'bank_id' => $this->selectedBanks,
        ]);

        $this->selectedBanks = null;

        return redirect()->back()->with('message', 'Bank Attached successfully');
    }

}

