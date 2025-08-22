<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <li class="list-group-item d-flex justify-content-between align-items-center mb-2" id="todo-{{ $todo->id }}">
    <div class="todo-content">
        <span class="todo-title">{{ $todo->title }}</span>
        <p class="todo-description">{{ $todo->description }}</p>
    </div>
    <form action="{{ route('todos.update', $todo->id) }}" method="POST" class="edit-form flex-grow-1 me-2">
        @csrf
        @method('PUT')
        <div class="d-flex flex-column">
            <input type="text" name="title" value="{{ $todo->title }}" class="form-control mb-2" required>
            <textarea name="description" class="form-control mb-2" rows="3">{{ $todo->description }}</textarea>
            <button type="submit" class="btn btn-sm btn-success update-btn">Cập nhật</button>
        </div>
    </form>
    <div class="d-flex">
        <button class="edit-btn btn btn-sm btn-warning me-2">Sửa</button>
        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="d-inline delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
        </form>
    </div>
</li>
</body>
</html>