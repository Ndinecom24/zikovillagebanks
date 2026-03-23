<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class FileUploads extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'file_uploads';

    protected $fillable = [
        'uuid',
        'name',
        'original_name',
        'size',
        'path',
        'ext',
        'mime_type',
        'folder',
        'model_id',
        'modal_code',
        'model_code',
        'type',
        'description',
        'uploaded_by',
    ];

    /* ── Relationships ─────────────────── */

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /* ── Accessors ─────────────────────── */

    /**
     * Human-readable file size.
     */
    public function getHumanSizeAttribute(): string
    {
        $bytes = (float) $this->size; // stored as MB string

        if ($bytes >= 1) {
            return number_format($bytes, 2) . ' MB';
        }

        return number_format($bytes * 1024, 0) . ' KB';
    }

    /**
     * Get the Font Awesome icon class for this file type.
     */
    public function getIconClassAttribute(): string
    {
        return match (strtolower($this->ext ?? '')) {
            'PDF' => 'fa-file-PDF text-danger',
            'doc', 'docx' => 'fa-file-word text-primary',
            'xls', 'xlsx', 'csv' => 'fa-file-excel text-success',
            'ppt', 'pptx' => 'fa-file-powerpoint text-warning',
            'jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp' => 'fa-file-image text-info',
            'zip', 'rar', '7z', 'tar', 'gz' => 'fa-file-archive text-secondary',
            'txt', 'log' => 'fa-file-alt text-muted',
            default => 'fa-file text-secondary',
        };
    }

    /**
     * Get the display name (prefer original_name, fallback to name).
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->original_name ?: $this->name;
    }

    /**
     * Get the download URL.
     */
    public function getDownloadUrlAttribute(): string
    {
        $storagePath = str_replace('public/', '', $this->path);
        return asset('storage/' . $storagePath);
    }

    /**
     * Check if file physically exists.
     */
    public function fileExists(): bool
    {
        return Storage::exists($this->path);
    }

    /* ── Scopes ────────────────────────── */

    public function scopeForEntity($query, int $modelId, ?string $type = null)
    {
        $query->where('model_id', $modelId);
        if ($type) {
            $query->where('type', $type);
        }
        return $query;
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
