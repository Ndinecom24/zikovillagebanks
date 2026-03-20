<?php

namespace App\Http\Livewire\Documents;

use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\DocumentFolder;
use App\Models\IndependentProducer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DocumentManager extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    /* ── Navigation state ─────────────── */
    public $currentFolderId = null;
    public $breadcrumbs = [];

    /* ── Filters ──────────────────────── */
    public $search = '';
    public $filterCategory = '';
    public $filterClient = '';
    public $perPage = 15;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    /* ── Folder CRUD state ────────────── */
    public $showFolderModal = false;
    public $editingFolderId = null;
    public $folderName = '';
    public $folderParentId = null;

    /* ── Category CRUD state ──────────── */
    public $showCategoryModal = false;
    public $editingCategoryId = null;
    public $categoryName = '';
    public $categoryDescription = '';

    /* ── Upload state ─────────────────── */
    public $showUploadModal = false;
    public $uploadFiles = [];
    public $uploadCategoryId = '';
    public $uploadClientId = '';
    public $uploadDescription = '';

    /* ── Detail modal ─────────────────── */
    public $showDetailModal = false;
    public $detailDocument = null;

    /* ── Delete state ─────────────────── */
    public $deleteType = null;   // 'folder' or 'document'
    public $deleteId = null;
    public $deleteName = '';

    /* ── Rename folder state ──────────── */
    public $showRenameModal = false;
    public $renameFolderId = null;
    public $renameFolderName = '';

    /* ── Reference data ───────────────── */
    public $categories = [];
    public $clients = [];

    protected $queryString = [
        'search'         => ['except' => ''],
        'filterCategory' => ['except' => ''],
        'filterClient'   => ['except' => ''],
        'perPage'        => ['except' => 15],
    ];

    protected function rules()
    {
        return [
            'uploadFiles'       => 'required|array|min:1',
            'uploadFiles.*'     => 'file|max:20480',
            'uploadCategoryId'  => 'nullable|integer|exists:document_categories,id',
            'uploadClientId'    => 'nullable|integer|exists:independent_producers,id',
            'uploadDescription' => 'nullable|string|max:500',
        ];
    }

    protected $messages = [
        'uploadFiles.required' => 'Please select at least one file to upload.',
        'uploadFiles.*.max'    => 'Each file must not exceed 20 MB.',
    ];

    /* ══════════════════════════════════════
       LIFECYCLE
       ══════════════════════════════════════ */

    public function mount()
    {
        $this->loadReferenceData();
    }

    private function loadReferenceData()
    {
        $this->categories = DocumentCategory::orderBy('name')->get()->toArray();
        $this->clients    = IndependentProducer::select('id', 'name_of_ipp', 'system_ref')
            ->orderBy('name_of_ipp')
            ->get()
            ->toArray();
    }

    public function updatingSearch()      { $this->resetPage(); }
    public function updatingFilterCategory() { $this->resetPage(); }
    public function updatingFilterClient()   { $this->resetPage(); }

    /* ══════════════════════════════════════
       FOLDER NAVIGATION
       ══════════════════════════════════════ */

    public function openFolder($folderId)
    {
        $this->currentFolderId = $folderId;
        $this->resetPage();
        $this->buildBreadcrumbs();
    }

    public function goToRoot()
    {
        $this->currentFolderId = null;
        $this->breadcrumbs = [];
        $this->resetPage();
    }

    private function buildBreadcrumbs()
    {
        $this->breadcrumbs = [];
        if ($this->currentFolderId) {
            $folder = DocumentFolder::find($this->currentFolderId);
            if ($folder) {
                $this->breadcrumbs = $folder->breadcrumb();
            }
        }
    }

    /* ══════════════════════════════════════
       SORTING
       ══════════════════════════════════════ */

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /* ══════════════════════════════════════
       FOLDER CRUD
       ══════════════════════════════════════ */

    public function openCreateFolderModal()
    {
        $this->reset(['editingFolderId', 'folderName']);
        $this->folderParentId = $this->currentFolderId;
        $this->showFolderModal = true;
    }

    public function closeFolderModal()
    {
        $this->showFolderModal = false;
        $this->reset(['editingFolderId', 'folderName', 'folderParentId']);
        $this->resetValidation();
    }

    public function saveFolder()
    {
        $this->validate([
            'folderName' => 'required|string|max:255',
        ]);

        DocumentFolder::updateOrCreate(
            ['id' => $this->editingFolderId],
            [
                'name'       => $this->folderName,
                'parent_id'  => $this->folderParentId ?: null,
                'created_by' => auth()->id(),
            ]
        );

        $msg = $this->editingFolderId ? 'Folder updated.' : 'Folder created.';
        $this->closeFolderModal();
        session()->flash('message', $msg);
    }

    public function openRenameFolderModal($folderId)
    {
        $folder = DocumentFolder::findOrFail($folderId);
        $this->renameFolderId   = $folder->id;
        $this->renameFolderName = $folder->name;
        $this->showRenameModal  = true;
    }

    public function closeRenameModal()
    {
        $this->showRenameModal = false;
        $this->reset(['renameFolderId', 'renameFolderName']);
        $this->resetValidation();
    }

    public function renameFolder()
    {
        $this->validate(['renameFolderName' => 'required|string|max:255']);
        $folder = DocumentFolder::findOrFail($this->renameFolderId);
        $folder->update(['name' => $this->renameFolderName]);
        $this->closeRenameModal();
        session()->flash('message', 'Folder renamed.');
    }

    public function confirmDeleteFolder($folderId)
    {
        $folder = DocumentFolder::findOrFail($folderId);
        $this->deleteType = 'folder';
        $this->deleteId   = $folder->id;
        $this->deleteName = $folder->name;
    }

    public function deleteFolder()
    {
        $folder = DocumentFolder::findOrFail($this->deleteId);

        // Delete all documents in this folder (and sub-folders) from storage
        $this->deleteFolderRecursive($folder);

        $this->cancelDelete();
        session()->flash('message', 'Folder and its contents deleted.');
    }

    private function deleteFolderRecursive(DocumentFolder $folder)
    {
        // Delete child folders recursively
        foreach ($folder->children as $child) {
            $this->deleteFolderRecursive($child);
        }
        // Delete documents in this folder
        foreach ($folder->documents as $doc) {
            if (Storage::exists($doc->file_path)) {
                Storage::delete($doc->file_path);
            }
            $doc->delete();
        }
        $folder->delete();
    }

    /* ══════════════════════════════════════
       CATEGORY CRUD
       ══════════════════════════════════════ */

    public function openCategoryModal($id = null)
    {
        $this->reset(['editingCategoryId', 'categoryName', 'categoryDescription']);
        if ($id) {
            $cat = DocumentCategory::findOrFail($id);
            $this->editingCategoryId   = $cat->id;
            $this->categoryName        = $cat->name;
            $this->categoryDescription = $cat->description;
        }
        $this->showCategoryModal = true;
    }

    public function closeCategoryModal()
    {
        $this->showCategoryModal = false;
        $this->reset(['editingCategoryId', 'categoryName', 'categoryDescription']);
        $this->resetValidation();
    }

    public function saveCategory()
    {
        $this->validate([
            'categoryName'        => 'required|string|max:255',
            'categoryDescription' => 'nullable|string|max:500',
        ]);

        DocumentCategory::updateOrCreate(
            ['id' => $this->editingCategoryId],
            [
                'name'        => $this->categoryName,
                'description' => $this->categoryDescription,
            ]
        );

        $msg = $this->editingCategoryId ? 'Category updated.' : 'Category created.';
        $this->closeCategoryModal();
        $this->loadReferenceData();
        session()->flash('message', $msg);
    }

    public function deleteCategory($id)
    {
        $cat = DocumentCategory::findOrFail($id);
        // Nullify documents referencing this category
        Document::where('category_id', $id)->update(['category_id' => null]);
        $cat->delete();
        $this->loadReferenceData();
        session()->flash('message', 'Category deleted.');
    }

    /* ══════════════════════════════════════
       FILE UPLOAD
       ══════════════════════════════════════ */

    public function openUploadModal()
    {
        $this->reset(['uploadFiles', 'uploadCategoryId', 'uploadClientId', 'uploadDescription']);
        $this->showUploadModal = true;
    }

    public function closeUploadModal()
    {
        $this->showUploadModal = false;
        $this->reset(['uploadFiles', 'uploadCategoryId', 'uploadClientId', 'uploadDescription']);
        $this->resetValidation();
    }

    public function uploadNewFiles()
    {
        $this->validate();

        $count = 0;
        foreach ($this->uploadFiles as $file) {
            $originalName = $file->getClientOriginalName();
            $extension    = strtolower($file->getClientOriginalExtension());
            $safeBase     = preg_replace("/[^a-zA-Z0-9_\-]/", "_", pathinfo($originalName, PATHINFO_FILENAME));
            $fileName     = $safeBase . '_' . time() . '_' . Str::random(4) . '.' . $extension;
            $size         = number_format($file->getSize() / 1048576, 2);

            $storagePath = 'documents';
            if ($this->currentFolderId) {
                $storagePath .= '/folder_' . $this->currentFolderId;
            }
            $path = $file->storeAs('public/' . $storagePath, $fileName);

            Document::create([
                'folder_id'      => $this->currentFolderId,
                'category_id'    => $this->uploadCategoryId ?: null,
                'client_id'      => $this->uploadClientId ?: null,
                'file_name'      => $fileName,
                'original_name'  => $originalName,
                'file_path'      => $path,
                'file_type'      => $file->getMimeType(),
                'file_extension' => $extension,
                'mime_type'      => $file->getMimeType(),
                'file_size'      => $size,
                'description'    => $this->uploadDescription,
                'uploaded_by'    => auth()->id(),
            ]);
            $count++;
        }

        $this->closeUploadModal();
        session()->flash('message', $count . ' file(s) uploaded successfully.');
    }

    /* ══════════════════════════════════════
       VIEW DETAIL
       ══════════════════════════════════════ */

    public function viewDocument($docId)
    {
        $this->detailDocument = Document::with(['folder', 'category', 'client', 'uploader'])->find($docId);
        $this->showDetailModal = true;
    }

    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->detailDocument  = null;
    }

    /* ══════════════════════════════════════
       DELETE DOCUMENT
       ══════════════════════════════════════ */

    public function confirmDeleteDocument($id)
    {
        $doc = Document::findOrFail($id);
        $this->deleteType = 'document';
        $this->deleteId   = $doc->id;
        $this->deleteName = $doc->original_name ?: $doc->file_name;
    }

    public function executeDelete()
    {
        if ($this->deleteType === 'folder') {
            $this->deleteFolder();
        } elseif ($this->deleteType === 'document') {
            $doc = Document::findOrFail($this->deleteId);
            if (Storage::exists($doc->file_path)) {
                Storage::delete($doc->file_path);
            }
            $doc->delete();
            $this->cancelDelete();
            session()->flash('message', 'Document deleted.');
        }
    }

    public function cancelDelete()
    {
        $this->deleteType = null;
        $this->deleteId   = null;
        $this->deleteName = '';
    }

    /* ══════════════════════════════════════
       HELPERS
       ══════════════════════════════════════ */

    public function clearFilters()
    {
        $this->search         = '';
        $this->filterCategory = '';
        $this->filterClient   = '';
        $this->resetPage();
    }

    private function getStats(): array
    {
        $totalDocuments  = Document::count();
        $totalSizeMB     = (float) Document::sum('file_size');
        $totalFolders    = DocumentFolder::count();
        $totalCategories = DocumentCategory::count();
        $recentUploads   = Document::where('created_at', '>=', now()->subDays(7))->count();

        return compact('totalDocuments', 'totalSizeMB', 'totalFolders', 'totalCategories', 'recentUploads');
    }

    /* ══════════════════════════════════════
       RENDER
       ══════════════════════════════════════ */

    public function render()
    {
        // Subfolders in current folder
        $subfolders = DocumentFolder::where('parent_id', $this->currentFolderId)
            ->orderBy('name')
            ->get();

        // Documents in current folder (with filters)
        $documents = Document::query()
            ->where('folder_id', $this->currentFolderId)
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('file_name', 'LIKE', '%' . $this->search . '%')
                       ->orWhere('original_name', 'LIKE', '%' . $this->search . '%')
                       ->orWhere('description', 'LIKE', '%' . $this->search . '%');
                });
            })
            ->when($this->filterCategory, fn($q) => $q->where('category_id', $this->filterCategory))
            ->when($this->filterClient, fn($q) => $q->where('client_id', $this->filterClient))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        // Folder tree for sidebar
        $folderTree = DocumentFolder::whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('name')
            ->get();

        $allCategories = DocumentCategory::orderBy('name')->get();

        return view('livewire.documents.document-manager', [
            'subfolders'    => $subfolders,
            'documents'     => $documents,
            'folderTree'    => $folderTree,
            'allCategories' => $allCategories,
            'stats'         => $this->getStats(),
        ])->layout('layouts.main.master-livewire');
    }
}
