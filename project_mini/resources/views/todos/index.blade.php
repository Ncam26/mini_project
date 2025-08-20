<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
    <title>To-do List</title>
    <style>
        body { 
            font-family: sans-serif; 
            max-width: 600px; 
            margin: 2em auto; 
            padding: 1em; 
            background: linear-gradient(135deg, #8052ec, #d161ff);
            border-radius: 8px;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            background-color: white;
            border-radius: 8px;
        }
        .edit-form {
            display: none;
        }
        .todo-description {
            font-size: 0.9em;
            color: #555;
            margin-top: 5px;
        }
    </style>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">TO-DO-LIST</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTodoModal">
            Thêm công việc mới
        </button>
        <div class="modal fade" id="addTodoModal" tabindex="-1" aria-labelledby="addTodoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTodoModalLabel">Thêm công việc mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addTodoForm" action="{{ route('todos.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="text" name="title" class="form-control" placeholder="Tiêu đề công việc" required>
                            </div>
                            <div class="mb-3">
                                <textarea name="description" class="form-control" rows="3" placeholder="Thêm mô tả..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tạo công việc</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <ul class="list-group mt-4">
            @foreach($todos as $todo)
                <li class="list-group-item d-flex justify-content-between align-items-center mb-2" id="todo-{{ $todo->id }}">
                    <div>
                        <span class="todo-title">{{ $todo->title }}</span>
                        <p class="todo-description">{{ $todo->description }}</p>
                    </div>
                    <form action="{{ route('todos.update', $todo->id) }}" method="POST" class="edit-form flex-grow-1 me-2">
                        @csrf
                        @method('PUT')
                        <div class="d-flex">
                            <input type="text" name="title" value="{{ $todo->title }}" class="form-control me-2" required>
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
            @endforeach
        </ul>
        <br/>
    </div>
</body>
</html>