<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UserLoginAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Actions\User\RespondWithTokenAction;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function index()
    {
        $users = Cache::remember(User::INDEX_CACHE_KEY,config('cache.ttl'),function () {
            return User::all();
        });

        return response()->json(
            UserResource::collection(
                $users
            )
            );
    }

    public function register(
        StoreUserRequest $request,
        StoreUserAction $storeUserAction,
        RespondWithTokenAction $respondWithTokenAction
        )
    {
        $user = $storeUserAction($request->validated());

        return response()->json(
            ['token' => $respondWithTokenAction($user)]
        );

    }

    public function login(
        LoginUserRequest $request,
        UserLoginAction $userLoginAction,
        RespondWithTokenAction $respondWithTokenAction
    )
    {
        $user = $userLoginAction($request->validated());

        return response()->json(
            ['token' => $respondWithTokenAction($user)]
        );

    }

    public function show()
    {
        return response()->json(
            UserResource::make(
                Auth::user()
            )
        );
    }

    public function update(User $user,UpdateUserAction $updateUserAction)
    {
        $user = $updateUserAction($user);

        return response()->json(
            UserResource::make(
                Auth::user()
            )
        );
    }

}
