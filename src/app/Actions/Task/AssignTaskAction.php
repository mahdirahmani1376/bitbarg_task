<?php

namespace App\Actions\User;

use App\Models\Task;

class AssignTaskAction
{
    public function __invoke(Task $task, array $data): Task
    {
        $task->assigned_users()->attach($data['user_ids']);

        return $task;
    }
}
