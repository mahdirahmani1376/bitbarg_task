<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;


class RespondWithTokenAction
{
    public function __invoke(User $user) :string
    {
        return $user->createToken('access')->plainTextToken;
    }
}