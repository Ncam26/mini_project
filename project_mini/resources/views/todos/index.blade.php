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
            background: linear-gradient(
                135deg,
                 #8052ec,
                 #d161ff
                   );
            border-radius: 8px;
        }
        /* Thay thế .todo-item bằng các class Bootstrap */
        .todo-item { 
            display: flex;
            justify-content: space-between; 
            align-items: center; 
            border: 1px solid #ccc;
            padding: 10px; 
            margin-bottom: 10px;
            background-color: #2149daff;
        }
        
        .todo-item form { 
            margin: 0;  
        }
    </style>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">TO-DO-LIST</h1>

        <form action="{{ route('todos.store') }}" method="POST" class="d-flex mb-4">
            @csrf
            <input type="text" name="title" class="form-control me-2" placeholder="Thêm công việc mới" required>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form> 
        
        @if(count($todos) > 0)
            <ul class="list-group">
                @foreach($todos as $todo)
                    <li class="list-group-item d-flex justify-content-between align-items-center mb-2" id="todo-{{ $todo['id'] }}">
                        {{-- Tiêu đề công việc ban đầu --}}
                        <span class="todo-title flex-grow-1">{{ $todo['title'] }}</span>

                        {{-- Form chỉnh sửa (ẩn) --}}
                        <form action="{{ route('todos.update', $todo['id']) }}" method="POST" class="edit-form flex-grow-1 me-2" style="display: none;">
                            @csrf
                            @method('PUT')
                            <div class="d-flex">
                                <input type="text" name="title" value="{{ $todo['title'] }}" class="form-control me-2" required>
                                <button type="submit" class="btn btn-sm btn-success update-btn">Cập nhật</button>
                            </div>
                        </form>

                        <div class="d-flex">
                            {{-- Nút "Sửa" để chuyển sang chế độ chỉnh sửa --}}
                            <button class="edit-btn btn btn-sm btn-warning me-2">Sửa</button>

                            {{-- Form "Xóa" --}}
                            <form action="{{ route('todos.destroy', $todo['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-center">Không có công việc nào.</p>
        @endif
        
        <br/>
        
    </div>
</body>
</html>