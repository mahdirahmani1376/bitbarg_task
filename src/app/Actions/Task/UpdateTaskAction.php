<?php

namespace App\Actions\Task;

use App\Models\Task;

class UpdateTaskAction
{
    public function __invoke(Task $task, array $data): Task
    {
        $task->update($data);

        activiy_log(auth()->user(), $task);

        return $task;
    }
}
