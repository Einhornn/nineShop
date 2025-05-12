<!doctype html>
<html class="no-js" lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Xác nhận đơn hàng</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="img/jpg" href="../assets/img/logo/2.icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .confirmation { text-align: center; padding: 50px 0; }
        .confirmation h2 { margin-bottom: 20px; }
        .confirmation p { margin-bottom: 20px; }
        .confirmation a { color: #007bff; text-decoration: none; }
        .confirmation a:hover { text-decoration: underline; }
    </style>
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <div class="confirmation_area">
        <div class="container">
            <div class="confirmation">
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>
                <h2>Cảm ơn bạn đã đặt hàng!</h2>
                <p>Đơn hàng của bạn đã được ghi nhận. Chúng tôi sẽ liên hệ để xác nhận trong thời gian sớm nhất.</p>
                <p><a href="index.php">Quay lại trang chủ</a></p>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>

    <script src="../assets/js/main.js"></script>
</body>
</html>