import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    // Kiểm tra phần tử tồn tại trước khi dùng
    const todoList = document.querySelector('#todo-list');
    const addTodoForm = document.getElementById('addTodoForm');
    const modalElement = document.getElementById('addTodoModal');
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

    const modalInstance = modalElement ? new bootstrap.Modal(modalElement) : null;

 
     //Tạo HTML cho công việc mới
    
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
                <button type="button" class="edit-btn btn btn-sm btn-warning me-2">Sửa</button>
                <form action="/todos/${todo.id}" method="POST" class="d-inline delete-form">
                    <input type="hidden" name="_token" value="${csrfToken}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </div>
        </li>
        `;
    };

  
     //Thêm công việc mới
   
    if (addTodoForm && todoList) {
        addTodoForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = Object.fromEntries(new FormData(addTodoForm).entries());

            try {
                const response = await fetch(addTodoForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    const todo = await response.json();
                    todoList.insertAdjacentHTML('beforeend', createTodoHtml(todo));
                    addTodoForm.reset();
                    modalInstance?.hide();
                } else {
                    const errorData = await response.json();
                    alert('Lỗi: ' + (errorData.message || 'Không thể thêm công việc.'));
                }
            } catch (error) {
                console.error('Lỗi khi thêm công việc:', error);
            }
        });
    }


     // Sửa, Xóa, Cập nhật công việc
  
    todoList?.addEventListener('click', async (e) => {
        const item = e.target.closest('li.list-group-item');
        if (!item) return;

        // Sửa
        if (e.target.closest('.edit-btn')) {
            const todoContent = item.querySelector('.todo-content');
            const editForm = item.querySelector('.edit-form');
            if (todoContent && editForm) {
                todoContent.style.display = 'none';
                editForm.style.display = 'flex';
                e.target.style.display = 'none';
                editForm.querySelector('input[name="title"]')?.focus();
            }
        }

        //  Xóa
        const deleteForm = e.target.closest('.delete-form');
        if (deleteForm) {
            e.preventDefault();
            try {
                const response = await fetch(deleteForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new FormData(deleteForm)
                });
                if (response.ok) {
                    item.remove();
                } else {
                    const errorData = await response.json();
                    alert('Lỗi: ' + (errorData.message || 'Không thể xóa công việc.'));
                }
            } catch (error) {
                console.error('Lỗi khi xóa công việc:', error);
            }
        }
    });

    
     //Cập nhật công việc
    
    todoList?.addEventListener('submit', async (e) => {
        const editForm = e.target.closest('.edit-form');
        if (editForm) {
            e.preventDefault();
            const item = editForm.closest('li.list-group-item');
            const todoContent = item.querySelector('.todo-content');

            const data = {
                title: editForm.querySelector('input[name="title"]').value,
                description: editForm.querySelector('textarea[name="description"]').value
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
                    const todo = await response.json();
                    todoContent.querySelector('.todo-title').innerText = todo.title;
                    const desc = todoContent.querySelector('.todo-description');
                    if (desc) {
                        desc.innerText = todo.description || '';
                    } else if (todo.description) {
                        todoContent.insertAdjacentHTML('beforeend', `<p class="todo-description">${todo.description}</p>`);
                    }

                    editForm.style.display = 'none';
                    todoContent.style.display = 'block';
                    item.querySelector('.edit-btn').style.display = 'inline-block';
                } else {
                    const errorData = await response.json();
                    alert('Lỗi: ' + (errorData.message || 'Không thể cập nhật.'));
                }
            } catch (error) {
                console.error('Lỗi khi cập nhật công việc:', error);
            }
        }
    });
});
