<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Actions\User\StoreTaskAction;
use App\Actions\User\AssignTaskAction;
use App\Actions\User\DeleteTaskAction;
use App\Actions\User\UpdateTaskAction;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\UserAssignRequest;
use App\Actions\User\RemoveUserFromTaskAction;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
                TaskResource::collection(
                    Task::filter()
                )
            );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request,StoreTaskAction $storeTaskAction)
    {
        $task = $storeTaskAction($request->validated());

        return response()->json(
                TaskResource::make(
                    $task
                )
            );
    }

    public function assign(Task $task,AssignTaskAction $assignTaskAction,UserAssignRequest $userAssignRequest)
    {
        $task = $assignTaskAction($userAssignRequest->validated());

        return response()->json(
            TaskResource::make(
                $task
            )
        );
    }

    public function removeUser(Task $task,RemoveUserFromTaskAction $removeUserFromTaskAction,UserAssignRequest $userAssignRequest)
    {
        $task = $removeUserFromTaskAction($userAssignRequest->validated());

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
    public function update(UpdateTaskRequest $request, Task $task,UpdateTaskAction $updateTaskAction)
    {
        $task = $updateTaskAction($task,$request->validated());

        return response()->json(
                TaskResource::make(
                    $task
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task,DeleteTaskAction $deleteTaskAction)
    {
        $deleteTaskAction($task);

        return response()->json(
            [
                'message' => 'success'
            ]
        );
    }
}
