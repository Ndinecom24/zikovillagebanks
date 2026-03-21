<?php

namespace App\Http\Livewire\Clients;

use App\Models\ClientDetails;
use App\Models\FileUploads;
use Livewire\Component;

class ClientShow extends Component
{
    public $client;
    public $documents = [];
    public function mount($id)
    {
        // Get client
        $this->client = ClientDetails::findOrFail($id);

        // Get documents linked to this client
        $this->documents = FileUploads::where('model_id', $id)->get();
    }
    public function render()
    {
        return view('livewire.clients.client-show');
    }
}
