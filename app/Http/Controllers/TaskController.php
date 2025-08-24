<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin') || $user->hasPermissionTo('view-tasks')) {
            $tasks = Task::all();
            return view('tasks.index', compact('tasks'));
        } elseif ($user->hasPermissionTo('view-own-tasks')) {
            $tasks = Task::where('user_id', $user->id)->get();
            return view('tasks.index', compact('tasks'));
        }
        return redirect()->route('index')->with('error', 'You do not have permission to view tasks.');
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // Step 1: Validate Form Request 
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'due_date' => 'nullable|date',
        ]);

        // Step 2: Check for Validation Errors
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        try {

            // Step 3: Create New Task
            $task = new Task();
            $task->user_id = Auth::user()->id; // Assuming the user is authenticated
            $task->title = $request->title;
            $task->description = $request->description;
            $task->due_date = $request->due_date;
            $task->save();

            // Step 4: Redirect with Success/Error Message
            if ($task) {
                return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to create task. Please try again.');
            }
        } catch (Exception $e) {
            // Step 5: Handle Exception 
            dd($e->getMessage());
            return redirect()->back()->with('error', '.');
        }
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        // Step 1: Validate Form Request 
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'due_date' => 'nullable|date',
        ]);

        // Step 2: Check for Validation Errors
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        try {
            // Step 3: Update Task
            $task = Task::findOrFail($id);
            $task->title = $request->title;
            $task->description = $request->description;
            $task->due_date = $request->due_date;
            $task->save();

            // Step 4: Redirect with Success/Error Message
            if ($task) {
                return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update task. Please try again.');
            }
        } catch (Exception $e) {
            // Step 5: Handle Exception 
            dd($e->getMessage());
            return redirect()->back()->with('error', '.');
        }
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        if ($task) {
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
        }
        return redirect()->back()->with('error', 'Failed to delete task. Please try again.');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.view', compact('task'));
    }
}
