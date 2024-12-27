<?php

namespace App\Actions\User;

use App\Models\Task;
use App\Models\User;

class StoreTaskAction
{
    public function __invoke(array $data): Task
    {
        $task =  Task::create([
            "title" => $data["title"],
            "description" => $data["description"],
            "status" => $data["status"],
            "author_id" => $data["author_id"],
            "due_date" => $data["due_date"],
        ]);

        if (! empty($data['assigned_users']))
        {
            $task->assignedUsers->attach($data['assigned_users']);
        }

        return $task;
    }

}
