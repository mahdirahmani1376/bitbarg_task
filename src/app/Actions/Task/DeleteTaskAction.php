<?php

namespace App\Actions\User;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class DeleteTaskAction
{
    public function __invoke(Task $task): void
    {
        $task->delete();

        $task->assigned_users()->detach();

    }

}
