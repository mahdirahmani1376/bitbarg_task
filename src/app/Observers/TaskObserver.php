<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class TaskObserver
{
    public function created(Task $task): void
    {
        $this->forgetCache();

    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(Task $task): void
    {
        $this->forgetCache();

    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Task $task): void
    {
        $this->forgetCache();

    }

    private function forgetCache()
    {
        return Cache::forget(Task::INDEX_CACHE_KEY);
    }
}
