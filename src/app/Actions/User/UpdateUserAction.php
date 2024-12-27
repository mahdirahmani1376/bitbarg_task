<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UpdateUserAction
{
    public function __invoke(User $user,array $data): User
    {
        $user->update($data);
        
        return $user;
    }
}
