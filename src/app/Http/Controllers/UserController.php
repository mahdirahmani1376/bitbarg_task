<?php

namespace App\Http\Controllers;

use App\Actions\User\RespondWithTokenAction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UserLoginAction;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Auth\AuthenticationException;

class UserController extends Controller
{
    public function register(
        StoreUserRequest $request,
        StoreUserAction $storeUserAction,
        RespondWithTokenAction $respondWithTokenAction
        )
    {
        $user = $storeUserAction($request->validated());

        return ['token' => $respondWithTokenAction($user)];

    }

    public function login(
        LoginUserRequest $request,
        UserLoginAction $userLoginAction,
        RespondWithTokenAction $respondWithTokenAction
    )
    {
        $user = $userLoginAction($request->validated());

        return ['token' => $respondWithTokenAction($user)];

    }

    public function show()
    {
        return UserResource::make(
            Auth::user()
        );
    }


}
