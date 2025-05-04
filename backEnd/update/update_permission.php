<?php
require_once 'backEnd/config-database.php'; // Đúng đường dẫn file kết nối

// Nhận dữ liệu JSON từ client
$input = file_get_contents('php://input');
$permissions = json_decode($input, true);

if (!$permissions || !is_array($permissions)) {
    http_response_code(400);
    echo "Dữ liệu không hợp lệ!";
    exit;
}

try {
    $conn->beginTransaction();

    foreach ($permissions as $perm) {
        $employeeId = $perm['employee_id'] ?? null;
        $permissionId = $perm['permission_id'] ?? null;
        $checked = $perm['checked'] ?? null;

        if (!$employeeId || !$permissionId || $checked === null) {
            continue; // Bỏ qua nếu thiếu dữ liệu
        }

        // Lấy role_id hiện tại của nhân viên
        $stmt = $conn->prepare("SELECT role_id FROM user_roles WHERE user_id = ?");
        $stmt->execute([$employeeId]);
        $roleId = $stmt->fetchColumn();

        if (!$roleId) {
            continue; // Bỏ qua nếu nhân viên chưa có vai trò
        }

        if ($checked == 1) {
            // Thêm quyền nếu chưa có
            $stmt = $conn->prepare("INSERT IGNORE INTO role_permissions (role_id, permission_id) VALUES (?, ?)");
            $stmt->execute([$roleId, $permissionId]);
        } else {
            // Xóa quyền
            $stmt = $conn->prepare("DELETE FROM role_permissions WHERE role_id = ? AND permission_id = ?");
            $stmt->execute([$roleId, $permissionId]);
        }
    }

    $conn->commit();
    echo "OK";
} catch (Exception $e) {
    $conn->rollBack();
    http_response_code(500);
    echo "Lỗi: " . $e->getMessage();
}