<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientDetails extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'clients';
    protected $fillable =
        [
            'company_name',
            'phone',
            'email',
            'address_line_1',
            'address_line',
            'city',
            'province',
            'country',
            'tpin',
            'is_active',
            'created_by',
            'created_by_staff_no',
            'phone_area_code'
        ];

    /* ── Relationships ────────────────── */

    public function clientProcesses()
    {
        return $this->hasMany(ClientProcess::class, 'client_id');
    }

    public function activeProcesses()
    {
        return $this->hasMany(ClientProcess::class, 'client_id')->where('status', 'in_progress');
    }
}
