document.addEventListener('DOMContentLoaded', function () {
    var editButtons = document.querySelectorAll('.btn-edit-admin');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');
            var username = button.getAttribute('data-username');
            var password = button.getAttribute('data-password');
            var role = button.getAttribute('data-role');

            document.getElementById('edit_nama_admin').value = nama;
            document.getElementById('edit_username_admin').value = username;
            document.getElementById('edit_password_admin').value = password;
            document.getElementById('edit_id_role').value = role;

            var form = document.getElementById('editAdminForm');
            form.action = '/admin/' + id;

            var editModal = new bootstrap.Modal(document.getElementById('editAdminModal'));
            editModal.show();
        });
    });
});
