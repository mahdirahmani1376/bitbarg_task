<?php

namespace App\Actions\User;

use App\Models\Task;
use App\Models\User;
use App\Enums\TaskStatusEnum;
use Illuminate\Support\Facades\Cache;

class StoreTaskAction
{
    public function __invoke(array $data): Task
    {
        $task =  Task::create([
            "title" => $data["title"],
            "description" => $data["description"],
            "status" => TaskStatusEnum::PENDING->value,
            "author_id" => $data["author_id"],
            "due_date" => $data["due_date"],
        ]);

        return $task;
    }

}
