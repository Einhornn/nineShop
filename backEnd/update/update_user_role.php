<?php
require_once 'controllers/rolesController.php';
$controller = new RolesController();

$user_id = $_POST['user_id'];
$role_id = $_POST['role_id'];
$action = $_POST['action'];

if ($action === 'add') {
    $controller->assignRole($user_id, $role_id);
} else {
    $controller->removeRole($user_id, $role_id);
}

echo "OK";
