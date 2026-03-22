<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTaskComment extends Model
{
    use HasFactory;

    protected $table = 'client_task_comments';

    protected $fillable = [
        'client_task_progress_id',
        'user_id',
        'body',
    ];

    /* ── Relationships ────────────────── */

    public function taskProgress()
    {
        return $this->belongsTo(ClientTaskProgress::class, 'client_task_progress_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
