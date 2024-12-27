<?php

namespace App\Http\Controllers;

use App\Actions\Task\AssignTaskAction;
use App\Actions\Task\DeleteTaskAction;
use App\Actions\Task\RemoveUserFromTaskAction;
use App\Actions\Task\StoreTaskAction;
use App\Actions\Task\UpdateTaskAction;
use App\Enums\TaskStatusEnum;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UserAssignRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json(
            TaskResource::collection(
                Task::filter(
                    $request->all()
                )
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, StoreTaskAction $storeTaskAction)
    {
        $task = $storeTaskAction([
            ...$request->validated(),
            'author_id' => auth()->id(),
        ]);

        return response()->json(
            TaskResource::make(
                $task
            )
        );
    }

    public function assign(Task $task, AssignTaskAction $assignTaskAction, UserAssignRequest $userAssignRequest)
    {
        $task = $assignTaskAction($task, $userAssignRequest->validated());

        return response()->json(
            TaskResource::make(
                $task
            )
        );
    }

    public function remove(Task $task, RemoveUserFromTaskAction $removeUserFromTaskAction, UserAssignRequest $userAssignRequest)
    {
        $task = $removeUserFromTaskAction($task, $userAssignRequest->validated());

        return response()->json(
            TaskResource::make(
                $task
            )
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response()->json(
            TaskResource::make($task)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task, UpdateTaskAction $updateTaskAction)
    {
        $task = $updateTaskAction($task, $request->validated());

        return response()->json(
            TaskResource::make(
                $task
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task, DeleteTaskAction $deleteTaskAction)
    {
        $deleteTaskAction($task);

        return response()->json(
            [
                'message' => 'success',
            ]
        );
    }

    public function complete(Task $task, UpdateTaskAction $updateTaskAction)
    {
        $task = $updateTaskAction($task, [
            'status' => TaskStatusEnum::COMPLETED,
        ]);

        return response()->json(
            TaskResource::make($task)
        );
    }
}
