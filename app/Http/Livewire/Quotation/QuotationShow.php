<?php

namespace App\Http\Livewire\Quotation;

use App\Models\ClientDetails;
use App\Models\GisQuotations;
use App\Models\GisQuotationsItems;
use Livewire\Component;

class QuotationShow extends Component
{
    public $quotation, $quotations_items, $client;

    public function mount($uuid)
    {
        $this->quotation = GisQuotations::where('uuid',$uuid)->first();
        $this->quotations_items = GisQuotationsItems::where('quotation_id', $this->quotation->id)
            ->get();
        $this->client = ClientDetails::where('id', $this->quotation->client_id )->first();

    }
    public function render()
    {
        return view('livewire.quotation.quotation-show');
    }
}

