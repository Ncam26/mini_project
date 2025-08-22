// app.js
import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    // Khai báo các biến DOM chính
    const todoList = document.querySelector('#todo-list'); 
    const addTodoForm = document.getElementById('addTodoForm');
    const modalInstance = new bootstrap.Modal(document.getElementById('addTodoModal'));
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Hàm này tạo chuỗi HTML cho một công việc mới
    const createTodoHtml = (todo) => { 
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
                    <div class="d-flex flex-column">
                        <input type="text" name="title" value="${todo.title}" class="form-control mb-2" required>
                        <textarea name="description" class="form-control mb-2" rows="3">${todo.description || ''}</textarea>
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

    //  Xử lý form Thêm mới công việc
    addTodoForm.addEventListener('submit', async (e) => {
        e.preventDefault(); 
        const formData = new FormData(addTodoForm);
        const data = Object.fromEntries(formData.entries());

        try {
            // Gửi yêu cầu AJAX đến server
            const response = await fetch(addTodoForm.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest' // Báo cho Laravel biết đây là yêu cầu AJAX
                },
                body: JSON.stringify(data) // Chuyển dữ liệu thành JSON để gửi
            });

            if (response.ok) {
                const todo = await response.json(); 
                const newTodoHtml = createTodoHtml(todo);
                todoList.insertAdjacentHTML('beforeend', newTodoHtml); // Chèn HTML mới vào danh sách
                addTodoForm.reset();
                modalInstance.hide(); 
            } else {
                const errorData = await response.json();
                console.error('Lỗi khi thêm:', errorData);
                alert('Lỗi: ' + (errorData.message || 'Không thể thêm công việc.'));
            }
        } catch (error) {
            console.error('Lỗi khi thêm công việc:', error);
        }
    });

    //  Xử lý tất cả các hành động trên mỗi công việc (Sửa, Xóa, Cập nhật)
    todoList.addEventListener('click', async (e) => {
        const item = e.target.closest('li.list-group-item');
        if (!item) return;

        // Xử lý nút Sửa
        const editBtn = e.target.closest('.edit-btn'); 
        if (editBtn) {
            e.preventDefault();
            const todoContent = item.querySelector('.todo-content');
            const editForm = item.querySelector('.edit-form');
            todoContent.style.display = 'none'; 
            editForm.style.display = 'flex'; 
            editBtn.style.display = 'none'; 
            editForm.querySelector('input[name="title"]').focus();
        }

        // Xử lý form Xóa
        const deleteForm = e.target.closest('.delete-form');
        if (deleteForm) {
            e.preventDefault();
            try {
                const response = await fetch(deleteForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new FormData(deleteForm) // Gửi form data
                });
                if (response.ok) {
                    item.remove(); 
                } else {
                    const errorData = await response.json();
                    console.error('Lỗi khi xóa:', errorData);
                    alert('Lỗi: ' + (errorData.message || 'Không thể xóa công việc.'));
                }
            } catch (error) {
                console.error('Lỗi khi xóa công việc:', error);
            }
        }
    });

    // Xử lý form Cập nhật công việc
    todoList.addEventListener('submit', async (e) => {
        const editForm = e.target.closest('.edit-form');
        if (editForm) {
            e.preventDefault();
            const item = editForm.closest('li.list-group-item');
            
            const newTitle = editForm.querySelector('input[name="title"]').value;
            const newDescription = editForm.querySelector('textarea[name="description"]').value;
            
            const data = {
                title: newTitle,
                description: newDescription,
            };
            
            try {
                const response = await fetch(editForm.action, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(data)
                });
                if (response.ok) {
                    const todo = await response.json(); // Lấy dữ liệu cập nhật
                    
                    const todoContent = item.querySelector('.todo-content'); 
                    todoContent.querySelector('.todo-title').innerText = todo.title; // Cập nhật tiêu đề
                    
                    const descriptionElement = todoContent.querySelector('.todo-description');
                    if (descriptionElement) {
                        descriptionElement.innerText = todo.description || ''; // Cập nhật mô tả
                    }
                    
                    // Cập nhật giá trị trong form để lần chỉnh sửa sau không bị mất dữ liệu
                    editForm.querySelector('input[name="title"]').value = todo.title; 
                    editForm.querySelector('textarea[name="description"]').value = todo.description || '';
                    
                    todoContent.style.display = 'block'; // Hiện lại nội dung
                    editForm.style.display = 'none';
                    item.querySelector('.edit-btn').style.display = 'inline-block'; // Hiện lại nút "Sửa"
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
    // Xử lý sự kiện click để đánh dấu công việc là đã hoàn thành
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
});
