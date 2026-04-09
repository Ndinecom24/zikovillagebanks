<?php

namespace App\Models\VillageBanking;

use Illuminate\Database\Eloquent\Relations\Pivot;

class VillageBankMember extends Pivot
{
    protected $table = 'village_bank_members';

    public $incrementing = true;

    protected $fillable = [
        'village_bank_id',
        'user_id',
        'role',
        'joined_at',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
    ];
}
