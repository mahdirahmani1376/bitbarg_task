<?php

namespace App\Actions\User;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class AssignTaskAction
{
    public function __invoke(Task $task,array $data): Task
    {
        $task->assigned_users()->attach($data['user_ids']);


        return $task;
    }

}
