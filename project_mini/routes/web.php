<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

// Route chính cho trang chủ.
// Sẽ hiển thị file view 'welcome.blade.php'
Route::get('/', function () {return view('trangchu');})->name('trangchu');

// Route hiển thị danh sách công việc và xử lý các thao tác CRUD.
// Route::resource sẽ tự động tạo các route sau:
// GET    /todos         -> index (hiển thị danh sách)
// POST   /todos         -> store (thêm mới)
// GET    /todos/{todo}  -> show (hiển thị chi tiết, nếu có)
// PUT    /todos/{todo}  -> update (cập nhật)
// DELETE /todos/{todo}  -> destroy (xóa)
Route::resource('todos', TodoController::class);
Route::post('/todos/{todo}', [TodoController::class, 'destroy']);
Route::patch('todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
