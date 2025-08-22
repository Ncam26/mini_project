<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Validation\ValidationException;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ]);
        
        $todo = Todo::create($validatedData);

        if ($request->ajax()) {
            return response()->json($todo);
        }

        return redirect()->route('todos.index');
    }
    
    public function update(Request $request, Todo $todo)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255', 
                'description' => 'nullable|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $todo->update($validatedData);

        if ($request->ajax()) {
            return response()->json($todo);
        }

        return redirect()->route('todos.index');
    }
    
    public function destroy(Request $request, Todo $todo)
    {
        $todo->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Công việc đã được xóa.']);
        }
        
        return redirect()->route('todos.index');
    }
    public function toggle(Todo $todo)
    {
        $todo->update(['completed' => !$todo->completed]);
        return back();
    }
}