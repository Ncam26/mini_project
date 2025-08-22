<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <li class="list-group-item d-flex justify-content-between align-items-start mb-2" id="todo-{{ $todo->id }}">
    <!-- Chế độ xem -->
    <div class="todo-content flex-grow-1 {{ $todo->completed ? 'text-decoration-line-through opacity-50' : '' }}">
        <span class="fw-bold">{{ $todo->title }}</span>
        @if($todo->due_date)
            <small class="ms-2 {{ now()->diffInDays($todo->due_date, false) <= 2 ? 'text-danger fw-bold' : 'text-muted' }}">
                (Hạn: {{ $todo->due_date->format('d/m/Y') }})
            </small>
        @endif
        <p class="mb-1">{{ $todo->description }}</p>
    </div>

    <!-- Form sửa ẩn -->
    <form action="{{ route('todos.update', $todo->id) }}" method="POST" class="edit-form flex-grow-1 me-2" style="display:none;">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $todo->title }}" class="form-control mb-2" required>
        <textarea name="description" class="form-control mb-2" rows="2">{{ $todo->description }}</textarea>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-sm btn-primary">💾 Lưu</button>
            <button type="button" class="btn btn-sm btn-secondary btn-cancel-edit">❌ Hủy</button>
        </div>
    </form>

    <!-- Nhóm nút -->
    <div class="d-flex flex-column align-items-center gap-1 ms-2">
        <!-- Nút hoàn thành -->
        <form action="{{ route('todos.toggle', $todo->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-sm {{ $todo->completed ? 'btn-success' : 'btn-outline-success' }}">
                ✔
            </button>
        </form>

        <!-- Nút sửa -->
        <button type="button" class="btn btn-sm btn-warning edit-btn">✏</button>

        <!-- Nút xóa -->
        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">🗑</button>
        </form>
    </div>
</li>

</body>
</html>