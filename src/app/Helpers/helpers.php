<?php

use App\Actions\ActivityLog\StoreActivityLogAction;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

if (! function_exists('activiy_log')) {
    function activiy_log(User $user, Model $model): ActivityLog
    {
        return app(StoreActivityLogAction::class)($user, $model);
    }
}
