<?php

namespace App\Http\Livewire\Files;

use App\Models\FileUploads;
use App\Models\IndependentProducer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class FileManager extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    /* ── Filters ──────────────────────── */
    public $search = '';
    public $filterType = '';
    public $filterExt = '';
    public $perPage = 15;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    /* ── Upload state ─────────────────── */
    public $showUploadModal = false;
    public $uploadFiles = [];
    public $uploadType = 'contracts';
    public $uploadModelId = '';
    public $uploadDescription = '';
    public $producers = [];

    /* ── Detail modal ─────────────────── */
    public $showDetailModal = false;
    public $detailFile = null;

    /* ── Delete state ─────────────────── */
    public $deleteId = null;
    public $deleteName = '';

    /* ── Allowed file types ───────────── */
    public $allowedExtensions = ['PDF', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'gif', 'zip', 'rar', 'txt'];

    protected $queryString = [
        'search' => ['except' => ''],
        'filterType' => ['except' => ''],
        'filterExt' => ['except' => ''],
        'perPage' => ['except' => 15],
    ];

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

    protected $messages = [
        'uploadFiles.required' => 'Please select at least one file to upload.',
        'uploadFiles.*.max' => 'Each file must not exceed 20MB.',
        'uploadModelId.required' => 'Please select an IPP to attach this file to.',
        'uploadModelId.exists' => 'The selected IPP does not exist.',
    ];

    /* ── Lifecycle ────────────────────── */

    public function mount()
    {
        $this->producers = IndependentProducer::select('id', 'name_of_ipp', 'system_ref')
            ->orderBy('name_of_ipp')
            ->get()
            ->toArray();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function updatingFilterExt()
    {
        $this->resetPage();
    }

    /* ── Sorting ──────────────────────── */

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /* ── Upload ───────────────────────── */

    public function openUploadModal()
    {
        $this->reset(['uploadFiles', 'uploadType', 'uploadModelId', 'uploadDescription']);
        $this->uploadType = 'contracts';
        $this->showUploadModal = true;
    }

    public function closeUploadModal()
    {
        $this->showUploadModal = false;
        $this->reset(['uploadFiles', 'uploadType', 'uploadModelId', 'uploadDescription']);
        $this->resetValidation();
    }

    public function uploadNewFiles()
    {
        $this->validate();

        $ipp = IndependentProducer::find($this->uploadModelId);
        $count = 0;

        foreach ($this->uploadFiles as $file) {
            $originalName = $file->getClientOriginalName();
            $safeBase = preg_replace("/[^a-zA-Z0-9_\-]/", "_", pathinfo($originalName, PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $fileName = $safeBase . '_' . time() . '_' . Str::random(4) . '.' . $extension;
            $size = number_format($file->getSize() / 1048576, 2); // bytes to MB
            $path = $file->storeAs('public/' . $this->uploadType, $fileName);

            FileUploads::create([
                'uuid' => Str::uuid()->toString(),
                'name' => $fileName,
                'original_name' => $originalName,
                'size' => $size,
                'path' => $path,
                'ext' => strtolower($extension),
                'mime_type' => $file->getMimeType(),
                'folder' => $this->uploadType,
                'model_id' => $ipp->id,
                'modal_code' => $ipp->system_ref ?? '',
                'model_code' => $ipp->system_ref ?? '',
                'type' => $this->uploadType,
                'description' => $this->uploadDescription,
                'uploaded_by' => auth()->id(),
            ]);
            $count++;
        }

        $this->closeUploadModal();
        session()->flash('message', $count . ' file(s) uploaded successfully.');
    }

    /* ── View Detail ──────────────────── */

    public function viewFile($fileId)
    {
        $this->detailFile = FileUploads::with('uploader')->find($fileId);
        $this->showDetailModal = true;
    }

    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->detailFile = null;
    }

    /* ── Delete ───────────────────────── */

    public function confirmDelete($id)
    {
        $file = FileUploads::findOrFail($id);
        $this->deleteId = $file->id;
        $this->deleteName = $file->original_name ?: $file->name;
    }

    public function deleteFile()
    {
        $file = FileUploads::findOrFail($this->deleteId);

        // Delete physical file
        if (Storage::exists($file->path)) {
            Storage::delete($file->path);
        }

        $file->delete();

        $this->deleteId = null;
        $this->deleteName = '';
        session()->flash('message', 'File deleted successfully.');
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    /* ── Helpers ──────────────────────── */

    public function clearFilters()
    {
        $this->search = '';
        $this->filterType = '';
        $this->filterExt = '';
        $this->resetPage();
    }

    private function getStats(): array
    {
        $totalFiles = FileUploads::count();
        $totalSizeMB = (float) FileUploads::sum('size');
        $uniqueTypes = FileUploads::distinct('type')->count('type');
        $recentUploads = FileUploads::where('created_at', '>=', now()->subDays(7))->count();

        return compact('totalFiles', 'totalSizeMB', 'uniqueTypes', 'recentUploads');
    }

    /* ── Render ───────────────────────── */

    public function render()
    {
        $files = FileUploads::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('name', 'LIKE', '%' . $this->search . '%')
                       ->orWhere('original_name', 'LIKE', '%' . $this->search . '%')
                       ->orWhere('description', 'LIKE', '%' . $this->search . '%');
                });
            })
            ->when($this->filterType, fn($q) => $q->where('type', $this->filterType))
            ->when($this->filterExt, fn($q) => $q->where('ext', $this->filterExt))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $fileTypes = FileUploads::select('type')
            ->distinct()
            ->whereNotNull('type')
            ->orderBy('type')
            ->pluck('type');

        $fileExtensions = FileUploads::select('ext')
            ->distinct()
            ->whereNotNull('ext')
            ->orderBy('ext')
            ->pluck('ext');

        $stats = $this->getStats();

        return view('livewire.files.file-manager', [
            'files' => $files,
            'fileTypes' => $fileTypes,
            'fileExtensions' => $fileExtensions,
            'stats' => $stats,
        ])->layout('layouts.main.master-livewire');
    }
}
