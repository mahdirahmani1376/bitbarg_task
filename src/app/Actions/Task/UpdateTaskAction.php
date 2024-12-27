<?php

namespace App\Actions\Task;

use App\Models\Task;

class UpdateTaskAction
{
    public function __invoke(Task $task, array $data): Task
    {
        $task->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'author_id' => $data['author_id'],
            'due_date' => $data['due_date'],
        ]);

        activiy_log(auth()->user(), $task);

        return $task;
    }
}
