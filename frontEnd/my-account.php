<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require '../backEnd/config-database.php';

$user_id = $_SESSION['user_id'];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_mode'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE users SET name=?, phone=?, address=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $phone, $address, $user_id);
    if ($stmt->execute()) {
        $success = true;
        $_SESSION['user_name'] = $name;
    }
}

$stmt = $conn->prepare("SELECT name, email, phone, address, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$avatar = "https://i.pravatar.cc/100?u=" . $user_id;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang cá nhân</title>
    <link rel="icon" type="image/jpeg" href="<?= htmlspecialchars($avatar) ?>">
    <style>
        .account-section {
            max-width: 800px;
            margin: 60px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            font-family: 'Libre Franklin', sans-serif;
        }
        .account-header {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .account-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-image: url('<?= htmlspecialchars($avatar) ?>');
            background-size: cover;
            background-position: center;
            margin-right: 20px;
        }
        .account-info h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .account-info p {
            margin: 5px 0 0;
            color: #666;
        }
        .account-details {
            line-height: 1.8;
            font-size: 14px;
            color: #555;
        }
        .btn-edit {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: grey;
            color: #fff;
            border-radius: 25px;
            text-transform: uppercase;
            font-size: 12px;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-edit:hover {
            background-color: black;
        }
        form input[type=text], form input[type=email] {
            width: 100%;
            padding: 8px;
            margin: 6px 0 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        .success-message {
            color: green;
            font-size: 14px;
        }
    </style>
    <script>
        function toggleEdit() {
            document.getElementById('edit-form').style.display = 'block';
            document.getElementById('view-info').style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="account-section">
        <div class="account-header">
            <div class="account-avatar"></div>
            <div class="account-info">
                <h2><?= htmlspecialchars($user['name']) ?></h2>
                <p><?= htmlspecialchars($user['email']) ?></p>
            </div>
        </div>

        <div class="account-details">

            <?php if ($success): ?>
                <p class="success-message">Cập nhật thành công!</p>
            <?php endif; ?>

            <div id="view-info">
                <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($user['phone']) ?></p>
                <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($user['address']) ?></p>
                <p><strong>Ngày tham gia:</strong> <?= date('d/m/Y', strtotime($user['created_at'])) ?></p>

                <a href="#" class="btn-edit" onclick="toggleEdit(); return false;">Sửa thông tin</a>
                <a href="index.php" class="btn-edit">Trang chủ</a>
                <a href="cart.php" class="btn-edit">Giỏ hàng</a>
                <a href="logout.php" class="btn-edit" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?')">Đăng xuất</a>
            </div>

            <form method="POST" id="edit-form" style="display: none;">
                <input type="hidden" name="edit_mode" value="1">

                <label>Họ tên</label>
                <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

                <label>Email</label>
                <input type="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>

                <label>Số điện thoại</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">

                <label>Địa chỉ</label>
                <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>">

                <input type="submit" class="btn-edit" value="Lưu thông tin">
                <a href="my-account.php" class="btn-edit">Hủy</a>
            </form>
        </div>
    </div>
</body>
</html>
