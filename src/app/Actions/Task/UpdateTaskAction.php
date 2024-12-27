<?php

namespace App\Actions\User;

use App\Models\Task;
use App\Models\User;

class UpdateTaskAction
{
    public function __invoke(Task $task,array $data): Task
    {
        $task->update([
            "title" => $data["title"],
            "description" => $data["description"],
            "status" => $data["status"],
            "author_id" => $data["author_id"],
            "due_date" => $data["due_date"],
        ]);

        return $task;
    }

}
