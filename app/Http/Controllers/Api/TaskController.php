<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        return response()->json([
            'tasks' => $project->tasks
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project)
    {
        $task = $project->tasks()->create($request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(['Chưa bắt đầu', 'Đang thực hiện', 'Đã hoàn thành'])],
        ]));

        return response()->json([
            'message' => 'Nhiệm vụ được tạo',
            'task' => $task
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Task $task)
    {
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Task $task)
    {
        $task->update($request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => ['required', Rule::in(['Chưa bắt đầu', 'Đang thực hiện', 'Đã hoàn thành'])],
        ]));

        return response()->json([
            'message' => 'Nhiệm vụ được cập nhật',
            'task' => $task
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'Nhiệm vụ được xóa'
        ], 200);
    }
}
