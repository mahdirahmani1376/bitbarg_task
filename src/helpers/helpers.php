<?php

use App\Actions\User\StoreActivityLogAction;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

if (! function_exists('activiy_log')) {
    function activiy_log(User $user, Model $model)
    {
        return app(StoreActivityLogAction::class)($user, $model);
    }
}
