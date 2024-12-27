<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Cache;

/**
 * @property string title
 * @property string description
 * @property string status
 * @property int author_id
 * @property string due_date
 * @property ?Collection assigned_users
 */
class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    public const INDEX_CACHE_KEY = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'status',
        'author_id',
        'due_date',
        'assigned_users',
    ];

    protected $casts = [
        'status' => TaskStatusEnum::class,
        'due_date' => 'timestamp',
    ];

    public static function filter(array $data): ?Collection
    {
        if (empty($data)) {
            return Cache::remember(static::INDEX_CACHE_KEY, config('cache.ttl'), function () {
                return static::all();
            });
        }

        $q = static::query();

        $q->when(! empty($data['title']), function (Builder $q) use ($data) {
            $q->where('title', 'like', "%{$data['title']}%");
        });

        $q->when(! empty($data['description']), function (Builder $q) use ($data) {
            $q->where('title', 'like', "%{$data['description']}%");
        });

        $q->when(! empty($data['author_id']), function (Builder $q) use ($data) {
            $q->where('author_id', '=', "{$data['author_id']}");
        });

        $q->when(! empty($data['due_date']), function (Builder $q) use ($data) {
            $q->where('due_date', '<', "{$data['due_date']}");
        });

        $q->when(! empty($data['status']), function (Builder $q) use ($data) {
            $q->where('status', '<', "{$data['status']}");
        });

        $q->when(! empty($data['assigned_users']), function (Builder $q) use ($data) {
            $q->whereHas('assignedUsers', function (?Builder $q) use ($data) {
                $q->whereIn('user_id', $data['assigned_users']);
            });
        });

        return $q->get();
    }

    public function assignedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_tasks', 'user_id', 'task_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getCacheKey(): string
    {
        return "task_{$this->id}";
    }

    public function acitvityLogs(): MorphMany
    {
        return $this->morphMany(ActivityLog::class, 'loggable');
    }
}
