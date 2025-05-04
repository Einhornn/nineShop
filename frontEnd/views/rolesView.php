<?php
require_once 'controllers/rolesController.php';
$controller = new RolesController();

$employees = $controller->getAllEmployees();
$roles = $controller->getAllRoles();
?>

<table border="1">
    <tr>
        <th>Nhân viên</th>
        <?php foreach ($roles as $role): ?>
            <th><?= $role['name'] ?></th>
        <?php endforeach; ?>
    </tr>

    <?php foreach ($employees as $emp): ?>
        <tr>
            <td><?= $emp['name'] ?></td>
            <?php foreach ($roles as $role): ?>
                <td>
                    <input 
                        type="checkbox"
                        class="role-checkbox"
                        data-user-id="<?= $emp['id'] ?>"
                        data-role-id="<?= $role['id'] ?>"
                        <?= $controller->hasRole($emp['id'], $role['id']) ? 'checked' : '' ?>
                    >
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('.role-checkbox').change(function () {
    const userId = $(this).data('user-id');
    const roleId = $(this).data('role-id');
    const isChecked = $(this).is(':checked');

    $.ajax({
        url: 'update_user_role.php',
        method: 'POST',
        data: {
            user_id: userId,
            role_id: roleId,
            action: isChecked ? 'add' : 'remove'
        },
        success: function (res) {
            console.log('Success', res);
        },
        error: function () {
            alert('Lỗi cập nhật quyền');
        }
    });
});
</script>
