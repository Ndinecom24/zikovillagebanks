<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_categories';

    protected $fillable = [
        'name',
        'description',
    ];

    /* ── Relationships ────────────────── */

    public function documents()
    {
        return $this->hasMany(Document::class, 'category_id');
    }
}
