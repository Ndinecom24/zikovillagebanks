<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use App\Traits\ScopedToVillageBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constitution extends Model
{
    use HasFactory;
    use ScopedToVillageBank;

    public string $villageBankScopeTier = 'direct';

    protected $table = 'village_bank_constitutions';

    protected $fillable = [
        'village_bank_id',
        'title',
        'content_type',
        'body',
        'file_path',
        'file_name',
        'version',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'version' => 'integer',
    ];

    /* ── Relationships ────────────────── */

    public function villageBank()
    {
        return $this->belongsTo(VillageBank::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function acknowledgements()
    {
        return $this->hasMany(ConstitutionAcknowledgement::class, 'constitution_id');
    }

    public function acknowledgedUsers()
    {
        return $this->belongsToMany(User::class, 'constitution_acknowledgements', 'constitution_id', 'user_id')
                    ->withPivot('acknowledged_at', 'version_acknowledged')
                    ->withTimestamps();
    }

    /* ── Helpers ──────────────────────── */

    public function isAcknowledgedBy($userId): bool
    {
        return $this->acknowledgements()
            ->where('user_id', $userId)
            ->where('version_acknowledged', $this->version)
            ->exists();
    }

    public function acknowledgementRate(): float
    {
        $totalMembers = $this->villageBank->members()->count();
        if ($totalMembers === 0) return 0;

        $acked = $this->acknowledgements()
            ->where('version_acknowledged', $this->version)
            ->count();

        return round(($acked / $totalMembers) * 100, 1);
    }

    public function isTextType(): bool
    {
        return $this->content_type === 'text';
    }

    public function isFileType(): bool
    {
        return $this->content_type === 'file';
    }

    /**
     * Get count of members who have NOT acknowledged the current version.
     */
    public function pendingCount(): int
    {
        $totalMembers = $this->villageBank->members()->count();
        $ackedCount   = $this->acknowledgements()
            ->where('version_acknowledged', $this->version)
            ->count();

        return max(0, $totalMembers - $ackedCount);
    }
}
