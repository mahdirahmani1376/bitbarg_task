<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/** 
* @property $user_id
* @property $before
* @property $after
* @property $changes
 */
class ActivityLog extends Model
{
    protected $fillable = [
        "user_id",
        "before",
        "after",
        "changes",
    ];

    protected $casts = [
        "before" => 'array',
        "after" => 'array',
        "changes" => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function loggable()
    {
        return $this->morphTo();
    }
    
}
