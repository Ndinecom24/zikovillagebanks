<?php

namespace App\Models\VillageBanking;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstitutionAcknowledgement extends Model
{
    use HasFactory;

    protected $table = 'constitution_acknowledgements';

    protected $fillable = [
        'constitution_id',
        'user_id',
        'version_acknowledged',
        'ip_address',
        'acknowledged_at',
    ];

    protected $casts = [
        'version_acknowledged' => 'integer',
        'acknowledged_at'      => 'datetime',
    ];

    /* ── Relationships ────────────────── */

    public function constitution()
    {
        return $this->belongsTo(Constitution::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
