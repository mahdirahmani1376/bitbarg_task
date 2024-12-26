<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;


class UserLoginAction
{
    public function __invoke(array $data) :User
    {
        $user = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if (! $user) {
            throw new AuthenticationException;
        }

        return Auth::user();
    }
}