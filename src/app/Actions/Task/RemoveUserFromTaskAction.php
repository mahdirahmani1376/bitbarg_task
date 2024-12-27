<?php

namespace App\Actions\Task;

use App\Models\Task;

class RemoveUserFromTaskAction
{
    public function __invoke(Task $task, array $data): Task
    {
        $task->assignedUsers()->detach($data['user_ids']);

        return $task;
    }
}
