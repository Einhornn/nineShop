<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// include 'header.php';

$username = $_SESSION['user_name'];
$email = $_SESSION['user_email'];
$avatar = $_SESSION['avatar'] ?? 'https://i.pravatar.cc/100';

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
            text-decoration: none; /* Loại bỏ dấu gạch chân */
        }

        .btn-edit:hover {
            background-color: black;
        }

    </style>
</head>
<body>
    <div class="account-section">
        <div class="account-header">
            <div class="account-avatar"></div>
            <div class="account-info">
                <h2><?= htmlspecialchars($username) ?></h2>
                <p><?= htmlspecialchars($email) ?></p>
            </div>
        </div>
        <div class="account-details">
            <p><strong>Ngày tham gia:</strong> 01/01/2023</p>
            <p><strong>Hạng tài khoản:</strong> Kim cương</p>
            <p><strong>Điểm tích lũy:</strong> 20</p>

            <a href="index.php" class="btn-edit">Trang chủ</a>
            <a href="cart.php" class="btn-edit">Giỏ hàng</a>
            <a href="logout.php" class="btn-edit" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?')">Đăng xuất</a>
        
        </div>
    </div>
</body>
</html>
