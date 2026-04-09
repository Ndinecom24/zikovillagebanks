<?php

namespace App\Models\Subscription;

use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    protected $table = 'training_programs';

    protected $fillable = [
        'title', 'description', 'category', 'trainer', 'location',
        'start_date', 'end_date', 'duration', 'fee', 'max_participants',
        'cover_image', 'status', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'fee'          => 'decimal:2',
        'is_featured'  => 'boolean',
        'start_date'   => 'date',
        'end_date'     => 'date',
    ];

    /* ── Relationships ────────────── */

    public function applications()
    {
        return $this->hasMany(TrainingApplication::class);
    }

    /* ── Scopes ───────────────────── */

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('start_date');
    }

    /* ── Helpers ──────────────────── */

    public function isFree(): bool
    {
        return $this->fee <= 0;
    }

    public function formattedFee(): string
    {
        return $this->isFree() ? 'Free' : 'K' . number_format($this->fee, 2);
    }

    public function spotsLeft(): ?int
    {
        if (!$this->max_participants) {
            return null; // unlimited
        }
        $approved = $this->applications()->where('status', 'approved')->count();
        return max(0, $this->max_participants - $approved);
    }

    public function isFull(): bool
    {
        $spots = $this->spotsLeft();
        return $spots !== null && $spots <= 0;
    }

    public function categoryLabel(): string
    {
        $labels = [
            'general'    => 'General',
            'finance'    => 'Finance & Accounting',
            'governance' => 'Governance & Compliance',
            'management' => 'Bank Management',
            'leadership' => 'Leadership',
        ];
        return $labels[$this->category] ?? ucfirst($this->category);
    }

    public function categoryColor(): string
    {
        $colors = [
            'general'    => '#2563eb',
            'finance'    => '#D97706',
            'governance' => '#7c3aed',
            'management' => '#0d9488',
            'leadership' => '#db2777',
        ];
        return $colors[$this->category] ?? '#64748b';
    }
}
