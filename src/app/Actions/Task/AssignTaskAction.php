<?php

namespace App\Actions\Task;

use App\Models\Task;

class AssignTaskAction
{
    public function __invoke(Task $task, array $data): Task
    {
        $task->assignedUsers()->syncWithoutDetaching($data['user_ids']);

        return $task;
    }
}
