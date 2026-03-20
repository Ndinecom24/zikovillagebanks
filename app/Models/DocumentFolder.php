<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentFolder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_folders';

    protected $fillable = [
        'name',
        'parent_id',
        'created_by',
    ];

    /* ── Relationships ────────────────── */

    public function parent()
    {
        return $this->belongsTo(DocumentFolder::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(DocumentFolder::class, 'parent_id')->orderBy('name');
    }

    /**
     * Recursively eager-load full tree of children.
     */
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'folder_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /* ── Helpers ──────────────────────── */

    /**
     * Return the breadcrumb path as an array of [id => name].
     */
    public function breadcrumb(): array
    {
        $crumbs = [];
        $folder = $this;
        while ($folder) {
            array_unshift($crumbs, ['id' => $folder->id, 'name' => $folder->name]);
            $folder = $folder->parent;
        }
        return $crumbs;
    }

    /**
     * Count all documents in this folder and its descendants.
     */
    public function totalDocumentCount(): int
    {
        $count = $this->documents()->count();
        foreach ($this->children as $child) {
            $count += $child->totalDocumentCount();
        }
        return $count;
    }
}
