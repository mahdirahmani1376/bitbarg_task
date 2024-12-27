<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'controller' => UserController::class,
], function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register')->name('register');
    Route::get('/show', 'show')->name('users.register')->middleware('auth:sanctum');
});

Route::group([
    'controller' => TaskController::class,
    'middleware' => ['auth:sanctum'],
    'prefix' => 'tasks'
], function () {
    Route::get('/','index')->name('tasks.index')->middleware('can:viewAny,task');
    Route::get('/{id}','index')->name('tasks.show')->middleware('can:view,task');
    Route::post('/','store')->name('tasks.store')->middleware('can:create,task');
    Route::post('/{id}/assign','assign')->name('tasks.assign')->middleware('can:assign,task');
    Route::put('/{id}','update')->name('tasks.update')->middleware('can:update,task');
    Route::delete('/{id}','destroy')->name('tasks.delete')->middleware('can:delete,task');
});
