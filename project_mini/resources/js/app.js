// app.js
import './bootstrap'; // Import các file cần thiết của Bootstrap

document.addEventListener('DOMContentLoaded', function() {
    // Khai báo các biến DOM chính
    const todoList = document.querySelector('.list-group');
    const addTodoForm = document.getElementById('addTodoForm');
    const modalInstance = new bootstrap.Modal(document.getElementById('addTodoModal'));
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Hàm này tạo chuỗi HTML cho một công việc mới
    // Dữ liệu được lấy từ đối tượng 'todo' trả về từ server
    const createTodoHtml = (todo) => {
        // Kiểm tra xem có mô tả không để tạo HTML tương ứng
        const descriptionHtml = todo.description ? `<p class="todo-description">${todo.description}</p>` : '';
        return `
            <li class="list-group-item d-flex justify-content-between align-items-center mb-2" id="todo-${todo.id}">
                <div class="todo-content">
                    <span class="todo-title">${todo.title}</span>
                    ${descriptionHtml}
                </div>
                <form action="/todos/${todo.id}" method="POST" class="edit-form flex-grow-1 me-2" style="display: none;">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="d-flex">
                        <input type="text" name="title" value="${todo.title}" class="form-control me-2" required>
                        <button type="submit" class="btn btn-sm btn-success update-btn">Cập nhật</button>
                    </div>
                </form>
                <div class="d-flex action-buttons">
                    <button class="edit-btn btn btn-sm btn-warning me-2">Sửa</button>
                    <form action="/todos/${todo.id}" method="POST" class="d-inline delete-form">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                    </form>
                </div>
            </li>
        `;
    };

    // 1. Xử lý sự kiện khi submit form Thêm mới công việc
    addTodoForm.addEventListener('submit', async (e) => {
        e.preventDefault(); // Ngăn trình duyệt tải lại trang
        const formData = new FormData(addTodoForm);
        const data = Object.fromEntries(formData.entries());

        try {
            const response = await fetch(addTodoForm.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest' // Báo cho Laravel biết đây là yêu cầu AJAX
                },
                body: JSON.stringify(data) // Chuyển dữ liệu thành JSON để gửi
            });

            if (response.ok) { // Nếu phản hồi thành công (status 200-299)
                const todo = await response.json(); // Phân tích phản hồi JSON
                const newTodoHtml = createTodoHtml(todo);
                todoList.insertAdjacentHTML('beforeend', newTodoHtml); // Chèn HTML vào danh sách
                addTodoForm.reset(); // Xóa nội dung form
                modalInstance.hide(); // Ẩn modal
            } else {
                const errorData = await response.json();
                console.error('Lỗi khi thêm:', errorData);
                alert('Lỗi: ' + (errorData.message || 'Không thể thêm công việc.'));
            }
        } catch (error) {
            console.error('Lỗi khi thêm công việc:', error);
        }
    });

    // 2. Sử dụng Event Delegation để xử lý tất cả các hành động trên mỗi công việc
    // Sự kiện click trên danh sách công việc
    todoList.addEventListener('click', (e) => {
        const item = e.target.closest('li.list-group-item'); 
        if (!item) return;  // Nếu không phải là phần tử li, thoát hàm
        // Xử lý nút Sửa
        const editBtn = e.target.closest('.edit-btn');
        if (editBtn) {
            e.preventDefault();
            const todoContent = item.querySelector('.todo-content');
            const editForm = item.querySelector('.edit-form');
            todoContent.style.display = 'none'; 
            editForm.style.display = 'flex'; // Hiển thị form chỉnh sửa
            editBtn.style.display = 'none'; // Ẩn nút "Sửa"
            editForm.querySelector('input[name="title"]').focus(); // Tập trung vào ô nhập liệu
        }

        // Xử lý form Xóa
        const deleteForm = e.target.closest('.delete-form');
        if (deleteForm) {
            e.preventDefault();
            try {
                fetch(deleteForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new FormData(deleteForm) 
                }).then(response => {
                    if (response.ok) {
                        item.remove(); // Xóa phần tử khỏi DOM
                    } else {
                        response.json().then(errorData => {
                            console.error('Lỗi khi xóa:', errorData);
                            alert('Lỗi: ' + (errorData.message || 'Không thể xóa công việc.'));
                        });
                    }
                });
            } catch (error) {
                console.error('Lỗi khi xóa công việc:', error);
            }
        }
    });

    // 3. Xử lý form Cập nhật công việc
    todoList.addEventListener('submit', async (e) => {
        const editForm = e.target.closest('.edit-form');
        if (editForm) {
            e.preventDefault();
            const item = editForm.closest('li.list-group-item');
            const newTitle = editForm.querySelector('input[name="title"]').value;
            const data = { title: newTitle }; // Chuẩn bị dữ liệu gửi đi
            try {
                const response = await fetch(editForm.action, {
                    method: 'PUT', // Dùng phương thức PUT để cập nhật
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data) // Chuyển dữ liệu thành JSON
                });
                if (response.ok) {
                    const data = await response.json();   
                    const todoContent = item.querySelector('.todo-content');
                    todoContent.querySelector('.todo-title').innerText = data.title;  // Cập nhật tiêu đề
                    const descriptionElement = todoContent.querySelector('.todo-description');
                    if (descriptionElement) {
                        descriptionElement.innerText = data.description || ''; // Cập nhật mô tả
                    }
                    todoContent.style.display = 'block'; 
                    editForm.style.display = 'none';
                    item.querySelector('.edit-btn').style.display = 'inline-block'; 
                } else {
                    const errorData = await response.json();
                    console.error('Lỗi khi cập nhật:', errorData);
                    alert('Lỗi: ' + (errorData.message || 'Không thể cập nhật.'));
                }
            } catch (error) {
                console.error('Lỗi khi cập nhật:', error);
            }
        }
    });
});