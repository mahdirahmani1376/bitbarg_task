<?php

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use App\Actions\User\StoreActivityLogAction;

if (! function_exists('activiy_log')){
    function activiy_log(User $user,Model $model) {
        return app(StoreActivityLogAction::class)($user,$model);
    };
}
