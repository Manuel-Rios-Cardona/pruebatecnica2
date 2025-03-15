<?php

// app/Http/Controllers/Api/TaskController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user')->get();
        return response()->json($tasks);
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);
        
        $task = Task::create($data);
        return response()->json($task, 201);
    }
    
    public function show($id)
    {
        $task = Task::with('user')->findOrFail($id);
        return response()->json($task);
    }
    
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'sometimes|boolean',
        ]);
        
        $task->update($data);
        return response()->json($task);
    }
    
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}