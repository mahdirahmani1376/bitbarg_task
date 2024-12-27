<?php

namespace App\Actions\User;

use App\Models\Task;

class RemoveUserFromTaskAction
{
    public function __invoke(Task $task, array $data): Task
    {
        $task->assigned_users()->detach($data['user_ids']);

        return $task;
    }
}
