<?php

namespace App\Http\Livewire\Clients;

use App\Models\ClientDetails;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Clients extends Component
{
    use WithPagination, WithFileUploads;

    public $sortField = 'created_at';
    public $search;
    public $filterType;
    public $filterExt;
    public $perPage;
    public $allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif', 'zip', 'rar', 'txt'];
    public $clientList;

    /* ── Allowed file types ───────────── */
    protected $paginationTheme = 'bootstrap';
    protected $queryString = [
        'search' => ['except' => ''],
        'filterType' => ['except' => ''],
        'filterExt' => ['except' => ''],
        'perPage' => ['except' => 15],
    ];
    protected $messages = [
        'uploadFiles.required' => 'Please select at least one file to upload.',
        'uploadFiles.*.max' => 'Each file must not exceed 20MB.',
        'uploadModelId.required' => 'Please select an IPP to attach this file to.',
        'uploadModelId.exists' => 'The selected IPP does not exist.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->clientList = ClientDetails::all();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function updatingFilterExt()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        return view('livewire.clients.clients');
    }

    protected function rules()
    {
        return [
            'uploadFiles' => 'required|array|min:1',
            'uploadFiles.*' => 'file|max:20480', // 20MB max per file
            'uploadType' => 'required|string|max:100',
            'uploadModelId' => 'required|integer|exists:independent_producers,id',
            'uploadDescription' => 'nullable|string|max:500',
        ];
    }
}
