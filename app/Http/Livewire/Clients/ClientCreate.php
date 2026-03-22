<?php

namespace App\Http\Livewire\Clients;

use App\Models\ClientDetails;
use App\Models\FileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ClientCreate extends Component
{
    use WithPagination, WithFileUploads;
    public $company_name,
        $phone,
        $email,
        $address_line_1,
        $country,
        $city,
        $province, $tpin,
        $is_active;
    public $allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif', 'zip', 'rar', 'txt'];
    public $filetype = [];

    public $uploadFiles = [];

    public $documents = [];
    protected function rules()
    {
        return [
            'company_name' => 'required|string|max:255',
            'phone' => 'required',
            'email' => 'required|email',
            'documents.*.filetype' => 'required_with:documents.*.file|string',
            'documents.*.file' => 'required_with:documents.*.filetype|file|max:20480',


        ];
    }

    public function mount()
    {
        $this->documents = [
            ['filetype' => '', 'file' => null]
        ];
    }

    public function addRow()
    {
        $last = end($this->documents);

        if (empty($last['file']) && empty($last['filetype'])) {
            session()->flash('error', 'Please fill the current row first');
            return;
        }

        $this->documents[] = ['filetype' => '', 'file' => null];
    }

    public function removeRow($index)
    {
        unset($this->documents[$index]);
        $this->documents = array_values($this->documents); // reindex
    }

    protected $messages = [
        'uploadFiles.required' => 'Please select at least one file to upload.',
        'uploadFiles.*.max' => 'Each file must not exceed 20MB.',

        'uploadModelId.exists' => 'The selected IPP does not exist.',
    ];

    public function render()
    {
        return view('livewire.clients.client-create');
    }

    public function createClient()
    {
        // ✅ Remove rows where BOTH filetype and file are empty
        $this->documents = array_filter($this->documents, function ($doc) {
            return !empty($doc['file']) || !empty($doc['filetype']);
        });

        $this->documents = array_values($this->documents); // reindex
        $this->validate();

        $user = Auth::user();

        $client = ClientDetails::create([
            'company_name' => $this->company_name,
            'phone' => $this->phone,
            'tpin' => $this->tpin,
            'email' => $this->email,
            'address_line_1' => $this->address_line_1,
            'country' => $this->country,
            'city' => $this->city,
            'province' => $this->province,
            'created_by' => $user->name,
            'created_by_staff_no' => $user->staff_no,
            'is_active' => $this->is_active ?? '1',
        ]);

        $this->uploadNewFiles($client->id);

        $this->resetInputs();

        session()->flash('message', 'Client and documents created successfully');
    }

    public function uploadNewFiles($clientId)
    {
        $count = 0;

        foreach ($this->documents as $doc) {

            $file = $doc['file'];
            $fileType = $doc['filetype'];

            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName = preg_replace("/[^a-zA-Z0-9_\-]/", "_", $originalName);

            $fileName = $safeName . '_' . time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $size = number_format($file->getSize() / 1048576, 2); // bytes to MB

            $path = $file->storeAs('public/client_documents', $fileName);

            FileUploads::create([
                'uuid' => Str::uuid(),
                'name' => $fileName,
                'original_name' => $file->getClientOriginalName(),
                'size' => $size,
                'path' => $path,
                'type' => $fileType,
                'model_id' => $clientId,
                'uploaded_by' => auth()->id(),
            ]);

            $count++;
        }

        session()->flash('message', "$count file(s) uploaded successfully.");
    }

    public function resetInputs()
    {
        $this->reset([
            'company_name',
            'phone',
            'email',
            'address_line_1',
            'country',
            'city',
            'province',
            'is_active',
        ]);

        // reset documents properly
        $this->documents = [
            ['filetype' => '', 'file' => null]
        ];
    }

}
