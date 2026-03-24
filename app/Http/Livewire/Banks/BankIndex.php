<?php

namespace App\Http\Livewire\Banks;

use App\Models\Banks;
use App\Services\HelperService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class BankIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $account_name,
        $account_no,
        $branch,
        $currency,
        $bank_name, $swift_address;

    protected $rules = [
        'account_name' => 'required',
        'account_no' => 'required|numeric',
        'branch' => 'required',
        'currency' => 'required',
        'bank_name' => 'required',
        ];

    public function render()
    {
        $banks = Banks::paginate(15);
        return view('livewire.banks.bank-index')->with(compact('banks'));
    }

    public function createBank()
    {
        // Validate form data
        $this->validate();
        DB::beginTransaction();
        // Generate a new invoice number format for the billing month
        try {

            $user = Auth::user();

            Banks::create([
                'account_name' => $this->account_name,
                'account_no' => $this->account_no,
                'branch' => $this->branch,
                'currency' => $this->currency,
                'bank_name' => $this->bank_name,
                'swift_address' => $this->swift_address,
                'created_by' => $user->name,
                'created_by_staff_no' => $user->staff_no,
            ]);

            DB::commit();
            // Redirect to invoice display page with a success message
            return redirect()->back()->with('message', 'Bank Saved successfully');
        } catch (\Exception $e) {

            DB::rollBack();

            session()->flash('error', $e->getMessage());
        }
    }
}
