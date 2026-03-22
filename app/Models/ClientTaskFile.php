<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ClientTaskFile extends Model
{
    use HasFactory;

    protected $table = 'client_task_files';

    protected $fillable = [
        'client_task_progress_id',
        'uploaded_by',
        'original_name',
        'stored_name',
        'path',
        'ext',
        'mime_type',
        'size_mb',
        'description',
    ];

    /* ── Relationships ────────────────── */

    public function taskProgress()
    {
        return $this->belongsTo(ClientTaskProgress::class, 'client_task_progress_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /* ── Accessors ────────────────────── */

    public function getHumanSizeAttribute(): string
    {
        $mb = (float) $this->size_mb;
        if ($mb >= 1) {
            return number_format($mb, 2) . ' MB';
        }
        return number_format($mb * 1024, 0) . ' KB';
    }

    public function getIconClassAttribute(): string
    {
        return match (strtolower($this->ext)) {
            'pdf'                       => 'fas fa-file-pdf text-danger',
            'doc', 'docx'               => 'fas fa-file-word text-primary',
            'xls', 'xlsx', 'csv'        => 'fas fa-file-excel text-success',
            'ppt', 'pptx'               => 'fas fa-file-powerpoint text-warning',
            'jpg', 'jpeg', 'png', 'gif', 'webp' => 'fas fa-file-image text-info',
            'zip', 'rar', '7z'          => 'fas fa-file-archive text-secondary',
            default                     => 'fas fa-file text-muted',
        };
    }

    public function getDownloadUrlAttribute(): string
    {
        return Storage::url($this->path);
    }
}
