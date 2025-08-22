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
<<<<<<< HEAD
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
        ]);
        
        $todo = Todo::create($validatedData);

        if ($request->ajax()) {
            return response()->json($todo);
        }

        return redirect()->route('todos.index');
=======
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'nullable|string', // Thêm dòng này
    ]);

    $todo = Todo::create($validatedData);

    if ($request->ajax()) {
        return response()->json($todo);
    }

    return redirect()->route('todos.index');
>>>>>>> 41930a9d13f02c5637d7c58e835f60f36d20bb7c
    }
    
    public function update(Request $request, Todo $todo)
    {
        try {
<<<<<<< HEAD
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable|string',
            ]);
=======
            $validatedData = $request->validate(['title' => 'required|max:255']);
>>>>>>> 41930a9d13f02c5637d7c58e835f60f36d20bb7c
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
}