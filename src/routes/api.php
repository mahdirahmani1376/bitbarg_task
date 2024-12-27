<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'controller' => UserController::class,
    'prefix' => 'users',
], function () {
    Route::get('/', 'index')->name('users.index')->middleware('auth:sanctum');
    Route::get('/{id}', 'show')->name('users.show')->middleware('auth:sanctum');
    Route::post('/login', 'login')->name('users.login');
    Route::post('/register', 'register')->name('users.register');
    Route::put('/update', 'update')->name('users.update')->middleware('auth:sanctum');
});

Route::group([
    'controller' => TaskController::class,
    'middleware' => ['auth:sanctum'],
    'prefix' => 'tasks',
], function () {
    Route::get('/', 'index')->name('tasks.index');
    Route::get('/{id}', 'index')->name('tasks.show')->middleware('can:view,task');
    Route::post('/', 'store')->name('tasks.store');
    Route::post('/{id}/assign', 'assign')->name('tasks.assign')->middleware('can:assign,task');
    Route::post('/{id}/remove_user', 'assign')->name('tasks.remove_user')->middleware('can:removeUser,task');
    Route::post('/{id}/complete', 'complete')->name('tasks.complete')->middleware('can:complete,task');
    Route::put('/{id}', 'update')->name('tasks.update')->middleware('can:update,task');
    Route::delete('/{id}', 'destroy')->name('tasks.delete')->middleware('can:delete,task');
});
