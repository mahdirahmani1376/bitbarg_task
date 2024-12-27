<?php

namespace App\Actions\User;

use App\Models\Task;

class DeleteTaskAction
{
    public function __invoke(Task $task): void
    {
        $task->delete();

        $task->assigned_users()->detach();

    }
}
