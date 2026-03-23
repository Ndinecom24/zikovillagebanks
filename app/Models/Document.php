<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'documents';

    protected $fillable = [
        'folder_id',
        'category_id',
        'client_id',
        'file_name',
        'original_name',
        'file_path',
        'file_type',
        'file_extension',
        'mime_type',
        'file_size',
        'description',
        'uploaded_by',
    ];

    /* ── Relationships ────────────────── */

    public function folder()
    {
        return $this->belongsTo(DocumentFolder::class, 'folder_id');
    }

    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    public function client()
    {
        return $this->belongsTo(IndependentProducer::class, 'client_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /* ── Accessors ────────────────────── */

    public function getHumanSizeAttribute(): string
    {
        $size = (float) $this->file_size;
        if ($size >= 1024) {
            return number_format($size / 1024, 2) . ' GB';
        }
        if ($size >= 1) {
            return number_format($size, 2) . ' MB';
        }
        return number_format($size * 1024, 0) . ' KB';
    }

    public function getIconClassAttribute(): string
    {
        $ext = strtolower($this->file_extension);
        return match (true) {
            in_array($ext, ['PDF']) => 'fas fa-file-PDF text-danger',
            in_array($ext, ['doc', 'docx']) => 'fas fa-file-word text-primary',
            in_array($ext, ['xls', 'xlsx', 'csv']) => 'fas fa-file-excel text-success',
            in_array($ext, ['ppt', 'pptx']) => 'fas fa-file-powerpoint text-warning',
            in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']) => 'fas fa-file-image text-info',
            in_array($ext, ['zip', 'rar', '7z']) => 'fas fa-file-archive text-secondary',
            in_array($ext, ['txt', 'log']) => 'fas fa-file-alt text-muted',
            default => 'fas fa-file text-secondary',
        };
    }

    public function getDownloadUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    public function getIsPreviewableAttribute(): bool
    {
        $ext = strtolower($this->file_extension);
        return in_array($ext, ['PDF', 'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->original_name ?: $this->file_name;
    }

    /* ── Methods ──────────────────────── */

    public function fileExists(): bool
    {
        return Storage::exists($this->file_path);
    }

    /* ── Scopes ───────────────────────── */

    public function scopeInFolder($query, $folderId)
    {
        return $query->where('folder_id', $folderId);
    }

    public function scopeOfCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeForClient($query, $clientId)
    {
        return $query->where('client_id', $clientId);
    }
}
