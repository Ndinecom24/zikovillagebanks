<?php

namespace App\Http\Livewire\Quotation;

use App\Models\BulkDailyRates;
use App\Models\ClientDetails;
use App\Models\GisQuotations;
use App\Models\GisQuotationsItems;
use App\Models\TaxTypes;
use App\Services\HelperService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Livewire\Component;

class QuotationCreate extends Component
{
    public $client;
    public $currencies;
    public $daily_rate_conversion_rate, $daily_rate_conversion_type, $daily_rate_id;

    public $tax;
    public $items = [];
    public $vat = 0;
    public $quotation_final = 0;
    public $exchange_rate = 1;
    public $quotation_zmw = 0;
    public $quotation_date, $currency, $full_justification, $unit_desc;


    protected $rules = [
        'quotation_date' => 'required|date',
        'currency' => 'required',
        'exchange_rate' => 'required|numeric',
        'items.*.description' => 'required',
        'items.*.quantity' => 'required|numeric|min:0',
        'items.*.unit_price' => 'required|numeric|min:0',
        'vat' => 'nullable|numeric|min:0',
    ];

    public function mount($id)
    {
        $this->client = ClientDetails::findOrfail($id);
//        $this->currencies = BulkDailyRates::distinct('from_currency')->pluck('from_currency');
//        $this->tax = TaxTypes::where('TAX_CODE', 'VAT 16%_NW')->first();
        $this->addRow();

    }

    public function addRow()
    {
        $this->items[] = [
            'description' => '',
            'quantity' => 0,
            'unit_price' => 0,
            'total' => 0,
        ];
    }

    public function removeRow($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);

        $this->calculateQuotation();
    }

//    public function updatedCurrency($value)
//    {
//        $this->setExchangeRate($value);
//    }
//
//    public function setExchangeRate($currency)
//    {
//        $tariffDate = Carbon::now();
//
//        if ($currency === 'ZMW') {
//
//            $this->daily_rate_conversion_rate = 1;
//            $this->daily_rate_conversion_type = 'System';
//            $this->daily_rate_id = null;
//
//            return;
//        }
//
//        $rate = DB::table('DAILY_RATES')
//            ->whereYear('conversion_date', $tariffDate->year)
//            ->whereMonth('conversion_date', $tariffDate->month)
//            ->where('from_currency', $currency)
//            ->where('to_currency', 'ZMW')
//            ->whereNull('deleted_at') // ⚠️ use lowercase unless your DB is uppercase
//            ->orderByDesc('conversion_date')
//            ->first();
//
//        $this->daily_rate_conversion_rate = $rate->conversion_rate ?? 1;
//        $this->daily_rate_conversion_type = $rate->conversion_type ?? 'System';
//        $this->daily_rate_id = $rate->id ?? null;
//
//    }

    public function calculateQuotation()
    {
        $subtotal = 0;

        foreach ($this->items as $index => $item) {

            $qty = floatval($item['quantity']);
            $price = floatval($item['unit_price']);

            $this->items[$index]['total'] = $qty * $price;

            $subtotal += $this->items[$index]['total'];
        }

        // VAT calculation
        $vatAmount = ($subtotal * floatval($this->vat)) / 100;

        // Final total
        $this->quotation_final = $subtotal + $vatAmount;

        // Convert to ZMW
        $this->quotation_zmw = $this->quotation_final * floatval($this->exchange_rate);
    }

    public function render()
    {
        return view('livewire.quotation.quotation-create');
    }

    public function updatedItems()
    {
        $this->calculateQuotation();
    }

    public function updatedVat()
    {
        $this->calculateQuotation();
    }

    public function updatedExchangeRate()
    {
        $this->calculateQuotation();
    }

    public function createQuotation()
    {
        // Validate form data
        $this->validate();
        DB::beginTransaction();
        // Generate a new invoice number format for the billing month
        try {
            $quotation_number_of_zeros = 5;
            $quotation_no = HelperService::createInvoice('IPP', 'gis_quotations_id_seq.NEXTVAL', now()->format('mY'), $quotation_number_of_zeros);
            $user = Auth::user();
            $quotationDate = Carbon::parse($this->quotation_date)
                ->format('Y-m-d H:i:s');

            $quotation = GisQuotations::create([
                'quotation_no' => $quotation_no,
                'client_id' => $this->client->id,
                'quotation_date' => $quotationDate,
                'currency' => $this->currency,
                'exchange_rate' => $this->exchange_rate,
                'unit_desc' => $this->unit_desc,
                'quotation_final_kwacha' => $this->quotation_zmw,
                'quotation_final' => $this->quotation_final,
                'vat' => $this->vat,
                'full_justification' => $this->full_justification,
                'uuid' => Str::uuid(),
                'created_by' => $user->name,
                'created_by_staff_no' => $user->staff_no,
            ]);
            foreach ($this->items as $item) {
                GisQuotationsItems::create([
                    'quotation_id' => $quotation->id,
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $item['total'],
                ]);
            }
            DB::commit();
            // Redirect to invoice display page with a success message
            return Redirect::route('quote.show', $quotation->uuid)
                ->with('message', 'Quotation Saved successfully');
        } catch (\Exception $e) {

            DB::rollBack();

            session()->flash('error', $e->getMessage());
        }
    }
}
