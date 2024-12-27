<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    public function created(User $user): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        return Cache::forget(User::INDEX_CACHE_KEY);
    }
}
