<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
    $todos = Todo::all();
    return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
    $request->validate(['title' => 'required|max:255']);
    
    Todo::create(['title' => $request->title]);

    return redirect()->route('todos.index');
    }

    public function create(todo $todo)
    {
    // Hiển thị form tạo công việc mới
    return view('todos.create', compact('todo'));
    }

    public function edit(Todo $todo)
    {
    // Hiển thị form chỉnh sửa công việc
    // Trả về view với biến $todo chứa thông tin công việc cần chỉnh sửa
    return view('todos.edit', compact('todo'));
    }
    
    public function update(Request $request, Todo $todo)
    {
    // Kiểm tra dữ liệu đầu vào
    $request->validate(['title' => 'required|max:255']);

    // Cập nhật công việc
    $todo->update(['title' => $request->title]);

    // Trả về phản hồi JSON
    return response()->json($todo);
    }
    
    public function destroy(Todo $todo)
    {
    // Xóa công việc
    // Trả về phản hồi JSON
    $todo->delete();
    return redirect()->route('todos.index');
    }
    public function show(Todo $todo)
    {
    // Hiển thị chi tiết công việc
        return view('todos.show', compact('todo'));
    }
   
}