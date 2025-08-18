import './bootstrap';
import * as bootstrap from 'bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    const todoList = document.querySelector('.list-group');

    // Sử dụng Event Delegation để xử lý sự kiện
    if (todoList) {
        todoList.addEventListener('click', async (e) => {
            const item = e.target.closest('li.list-group-item');
            if (!item) return;

            const editBtn = item.querySelector('.edit-btn');
            const updateBtn = item.querySelector('.update-btn');
            const todoTitle = item.querySelector('.todo-title');
            const editForm = item.querySelector('.edit-form');
            
            // Xử lý nút "Sửa"
            if (e.target === editBtn) {
                todoTitle.style.display = 'none';
                editForm.style.display = 'flex';
                editBtn.style.display = 'none';
                editForm.querySelector('input[name="title"]').focus();
            }

            // Xử lý nút "Cập nhật"
            if (e.target === updateBtn) {
                e.preventDefault();
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const newTitle = editForm.querySelector('input[name="title"]').value;

                try {
                    const response = await fetch(editForm.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-HTTP-Method-Override': 'PUT'
                        },
                        body: JSON.stringify({
                            _token: csrfToken,
                            _method: 'PUT',
                            title: newTitle
                        })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        todoTitle.innerText = data.title;
                        todoTitle.style.display = 'inline-block';
                        editForm.style.display = 'none';
                        editBtn.style.display = 'inline-block';
                    } else {
                        alert('Lỗi: ' + (data.message || 'Không thể cập nhật.'));
                    }
                } catch (error) {
                    alert('Có lỗi xảy ra: ' + error.message);
                }
            }
        });
    }
});