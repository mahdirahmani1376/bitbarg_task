<?php

namespace App\Actions\User;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DeleteTaskAction
{
    public function __invoke(Task $task): void
    {
        $task->delete();

        $task->assigned_users()->detach();

        activiy_log(auth()->user(),$task);
    }
}
