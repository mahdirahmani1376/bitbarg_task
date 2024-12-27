<?php

namespace App\Actions\Task;

use App\Models\Task;

class DeleteTaskAction
{
    public function __invoke(Task $task): void
    {
        activiy_log(auth()->user(), $task);

        $task->delete();

        $task->assigned_users()->detach();

    }
}
