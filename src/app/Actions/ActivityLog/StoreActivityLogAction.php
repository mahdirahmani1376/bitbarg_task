<?php

namespace App\Actions\User;

use App\Models\ActivityLog;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class StoreActivityLogAction
{
    public function __invoke(User $user, Model $model): Task
    {
        $log = ActivityLog::create([
            'user_id' => $user->id,
            'before' => $model->getOriginal(),
            'after' => $model->getDirty(),
            'changes' => $model->getChanges(),
        ]);

        return $log;
    }
}
