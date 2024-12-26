<?php

namespace App\Actions\User;

use App\Models\User;


class StoreUserAction
{
    public function __invoke(array $data) :User
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'name' => $data['name'],
        ]);
    }
}