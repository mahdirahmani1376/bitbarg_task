<?php

namespace App\Policies;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->isAdministrator()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        if ($user->isAuthorOfTask($task)) {
            return true;
        }

        if ($user->HasTaskAssignedTo($task)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        if ($user->isAuthorOfTask($task)) {
            return true;
        }

        return false;

    }

    public function complete(User $user, Task $task)
    {
        if (
            ($user->HasTaskAssignedTo($task) || $user->isAuthorOfTask($task))
            &&
            now() < $task->due_date
            &&
            $task->status != TaskStatusEnum::COMPLETED
        ) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        if ($user->isAuthorOfTask($task)) {
            return true;
        }

    }

    public function assign(User $user, Task $task): bool
    {
        if ($user->isAuthorOfTask($task)) {
            return true;
        }

        return false;
    }

    public function removeUser(User $user, Task $task): bool
    {
        if ($user->isAuthorOfTask($task)) {
            return true;
        }

        return false;
    }
}
