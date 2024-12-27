<?php

namespace App\Actions\ActivityLog;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class StoreActivityLogAction
{
    public function __invoke(User $user, Model $model): ActivityLog
    {
        $log = ActivityLog::create([
            'user_id' => $user->id,
            'before' => $model->getOriginal(),
            'after' => $model->getDirty(),
            'changes' => $model->getChanges(),
            'loggable_type' => $model::class,
            'loggable_id' => $model->getKey(),
        ]);

        return $log;
    }
}
