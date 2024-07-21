<div class="container-fluid panel" id="aUsers">
    <h1 class="mt-4">Users</h1>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary right" data-bs-toggle="modal" data-bs-target="#addUserModal"> <i class="fa fa-plus" aria-hidden="true"></i>Add User</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="userForm">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                                <div class="invalid-feedback">Please enter the username.</div>
                            </div>
                            <div class="mb-3">
                                <label for="roleID" class="form-label">Role</label>
                                <select class="form-control" id="roleID" name="roleID" required>

                                </select>
                                <div class="invalid-feedback">Please select a role.</div>
                            </div>
                            <div class="mb-3">
                                <label for="pass" class="form-label">Password</label>
                                <input type="password" class="form-control" id="pass" name="pass" required>
                                <div class="invalid-feedback">Please enter the password.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $.ajax({
            url: 'authentication/fetch_roles.php', // PHP script to fetch roles from the database
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                let roleSelect = $('#roleID');
                $.each(data, function(index, role) {
                    roleSelect.append('<option value="' + role.id + '">' + role.roleName + '</option>');
                });
            }
        });

        $('#userForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this)[0];
            if (form.checkValidity() === false) {
                e.stopPropagation();
                $(form).addClass('was-validated');
                return;
            }

            let formData = $(this).serialize();
            $.ajax({
                url: 'authentication/insert_user.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        alert('User added successfully!');
                        $('#userForm')[0].reset();
                        $('#userForm').removeClass('was-validated');
                    } else {
                        alert('Error adding user: ' + response.message);
                    }
                }
            });
        });
    });
</script>