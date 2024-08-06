<?php 
    include __DIR__ . '/header.php';

    if(isset($_SESSION['message'])) {
        echo "<script>
        Swal.fire({
            title: '{$_SESSION['message']['title']}',
            text: '{$_SESSION['message']['text']}',
            icon: 'success',
            confirmButtonText: 'OK'
            });
        </script>";

        unset($_SESSION['message']);
    } 

?>

<h2>User List</h2>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead class="thead-dark">
            <tr>
                <th>
                    <label for="filter-name">Name</label>
                    <input type="text" id="filter-name" class="form-control form-control-sm" placeholder="Filter by Name">
                </th>
                <th>
                    <label for="filter-email">Email</label>
                    <input type="text" id="filter-email" class="form-control form-control-sm" placeholder="Filter by Email">
                </th>
                <th>
                    <label for="filter-status">Status</label>
                    <select id="filter-status" class="form-control form-control-sm">
                        <option value="">Filter by Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </th>
                <th>
                    <label for="filter-admission_date">Admission Date</label>
                    <input type="date" id="filter-admission_date" class="form-control form-control-sm">
                </th>
                <th>
                    <label for="filter-created_at">Created Date</label>
                    <input type="date" id="filter-created_at" class="form-control form-control-sm">
                </th>
                <th>
                    <label for="filter-updated_at">Updated Date</label>
                    <input type="date" id="filter-updated_at" class="form-control form-control-sm">
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="user-table-body">

        </tbody>
    </table>
    <div id="no-data" class="alert alert-warning" style="display: none;">No users found.</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function fetchUsers() {
            const name = document.getElementById('filter-name').value;
            const email = document.getElementById('filter-email').value;
            const status = document.getElementById('filter-status').value;
            const admission_date = document.getElementById('filter-admission_date').value;
            const created_at = document.getElementById('filter-created_at').value;
            const updated_at = document.getElementById('filter-updated_at').value;

            const xhr = new XMLHttpRequest();
            xhr.open('GET', `/users/filter?name=${name}&email=${email}&status=${status}&admission_date=${admission_date}&created_at=${created_at}&updated_at=${updated_at}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const users = JSON.parse(xhr.responseText);
                    const tbody = document.getElementById('user-table-body');
                    tbody.innerHTML = '';
                    if (users.length > 0) {
                        users.forEach(user => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td>${user.status}</td>
                                <td>${user.admission_date}</td>
                                <td>${user.created_at}</td>
                                <td>${user.updated_at}</td>
                                <td>
                                    <a href="/user/edit/${user.id}" class="btn btn-primary btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(${user.id})">Delete</button>
                                </td>
                            `;
                            tbody.appendChild(row);
                        });
                        document.getElementById('no-data').style.display = 'none';
                    } else {
                        document.getElementById('no-data').style.display = 'block';
                    }
                }
            };
            xhr.send();
        }

        document.getElementById('filter-name').addEventListener('input', fetchUsers);
        document.getElementById('filter-email').addEventListener('input', fetchUsers);
        document.getElementById('filter-status').addEventListener('change', fetchUsers);
        document.getElementById('filter-admission_date').addEventListener('change', fetchUsers);
        document.getElementById('filter-created_at').addEventListener('change', fetchUsers);
        document.getElementById('filter-updated_at').addEventListener('change', fetchUsers);

        fetchUsers();

        const ws = new WebSocket('ws://localhost:8000/ws/');

        ws.onopen = function() {
            console.log('WebSocket connection opened.');
        };

        ws.onmessage = function(event) {
            console.log('WebSocket message received:', event.data);
            fetchUsers();  // Chame a função que atualiza a tabela
        };

        ws.onerror = function(event) {
            console.error('WebSocket error:', event);
        };

        ws.onclose = function() {
            console.log('WebSocket connection closed.');
        };

    });

    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/user/delete/${userId}`;
            }
        });
    }

</script>

<?php include __DIR__ . '/footer.php'; ?>