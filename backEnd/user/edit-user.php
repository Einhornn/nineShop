<?php
include '../config-database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: ../frontEnd/admin.php?msg=notfound");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? '';
    $email = $_POST["email"] ?? '';
    $phone = $_POST["phone"] ?? '';
    $address = $_POST["address"] ?? '';

    if ($name && $email && $phone && $address) {
        $sql = "UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Lỗi prepare: " . $conn->error);
        }

        $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);
        $stmt->execute();

        header("Location: ../../frontEnd/admin.php?page=users");
        exit();
    } else {
        header("Location: ../../frontEnd/admin.php?msg=empty");
        exit();
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        header("Location: ../frontEnd/admin.php?msg=notfound");
        exit();
    }
}
?>

<h2>Sửa người dùng</h2>
<form method="post">
    <input type="text" name="name" value="<?= $user['name'] ?>" placeholder="Tên">
    <input type="email" name="email" value="<?= $user['email'] ?>" placeholder="Email">
    <input type="text" name="phone" value="<?= $user['phone'] ?>" placeholder="SĐT">
    <input type="text" name="address" value="<?= $user['address'] ?>" placeholder="Địa chỉ">
    <button type="submit">Cập nhật</button>
</form>
