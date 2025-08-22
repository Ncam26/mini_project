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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;

        }
        .edit-form {
            display: none;
            flex-grow: 1;
            margin-right: 30px; 

        }
        .todo-description, .todo-due-date {
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

        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addTodoModal">
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
        
        <ul class="list-group mt-4" id="todo-list">
            @foreach($todos as $todo)
                @include('partials.todo_item', ['todo' => $todo])
            @endforeach
        </ul>
        
        <br/>
    </div>
</body>
</html>