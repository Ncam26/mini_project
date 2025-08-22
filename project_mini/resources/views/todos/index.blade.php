<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To‑do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: sans-serif;
            max-width: 700px;
            margin: 2em auto;
            padding: 1em;
            background: linear-gradient(135deg, #8052ec, #d161ff);
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            color: #fff;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background: #fff;
            color: #333;
            border-radius: 8px;
            margin-bottom: 10px;
            padding: 10px;
        }
        .todo-completed {
            text-decoration: line-through;
            opacity: 0.6;
        }
        .edit-form { 
            display: none; 
            width: 100%;
         }
        .view-mode { 
            flex: 1; 

        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <h1 class="text-center">📝 TO‑DO LIST</h1>

        <p class="text-center">Quản lý công việc</p>
        <button class="btn btn-light my-3" data-bs-toggle="modal" data-bs-target="#addTodoModal">+ Thêm công việc</button>

        <!-- Modal thêm mới -->
        <div class="modal fade" id="addTodoModal" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" action="{{ route('todos.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm công việc mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="title" class="form-control mb-2" placeholder="Tiêu đề" required>
                        <textarea name="description" class="form-control" placeholder="Mô tả..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Danh sách công việc -->
        <ul class="list-group">
            @foreach($todos as $todo)
            <li class="list-group-item">
                <div class="view-mode {{ $todo->completed ? 'todo-completed' : '' }}">
                    <strong>{{ $todo->title }}</strong>
                    <p>{{ $todo->description }}</p>
                    <div>
                        <form action="{{ route('todos.toggle', $todo->id) }}" method="POST" style="display:inline;">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm {{ $todo->completed ? 'btn-success' : 'btn-outline-success' }}">
                                ✔
                            </button>
                        </form>
                        <button type="button" class="btn btn-sm btn-warning btn-edit">✏ Sửa</button>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑</button>
                        </form>
                    </div>
                </div>

                <!-- Form chỉnh sửa -->
                <form class="edit-form" action="{{ route('todos.update', $todo->id) }}" method="POST">
                    @csrf @method('PUT')
                    <input type="text" name="title" class="form-control mb-2" value="{{ $todo->title }}">
                    <textarea name="description" class="form-control mb-2">{{ $todo->description }}</textarea>
                    <button class="btn btn-sm btn-primary">💾 Lưu</button>
                    <button type="button" class="btn btn-sm btn-secondary btn-cancel-edit">❌ Hủy</button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".btn-edit").forEach(btn => {
                btn.addEventListener("click", () => {
                    let item = btn.closest(".list-group-item");
                    item.querySelector(".view-mode").style.display = "none";
                    item.querySelector(".edit-form").style.display = "block";
                });
            });

            document.querySelectorAll(".btn-cancel-edit").forEach(btn => {
                btn.addEventListener("click", () => {
                    let item = btn.closest(".list-group-item");
                    item.querySelector(".edit-form").style.display = "none";
                    item.querySelector(".view-mode").style.display = "block";
                });
            });
        });
    </script>
</body>
</html>
