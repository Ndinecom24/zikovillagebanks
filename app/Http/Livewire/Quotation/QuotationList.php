<?php

namespace App\Http\Livewire\Quotation;

use App\Models\GisQuotations;
use Livewire\Component;

class QuotationList extends Component
{

    public function render()
    {
        $quotes = GisQuotations::paginate(15);
        return view('livewire.quotation.quotation-list')->with(compact('quotes'));
    }
}
