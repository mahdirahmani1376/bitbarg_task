<?php

namespace App\Actions\User;

use App\Models\User;

class UpdateUserAction
{
    public function __invoke(User $user, array $data): User
    {
        $user->update($data);

        activiy_log(auth()->user(), $user);

        return $user;
    }
}
