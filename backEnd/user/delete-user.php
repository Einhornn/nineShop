<?php
ob_start();
include '../config-database.php';

if (!isset($_GET['id'])) {
    header("Location: ../../frontEnd/admin.php?page=users&msg=notfound");
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../../frontEnd/admin.php?page=users&msg=deleted");
} else {
    header("Location: ../../frontEnd/admin.php?page=users&msg=error");
}
exit();
