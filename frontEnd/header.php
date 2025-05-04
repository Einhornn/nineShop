<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Nine Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="img/jpg" href="../assets/img/logo/2.icon.png">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico"> -->
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>

<body>
    <div class="offcanvas_menu">
                <div class="canvas_open">
                                <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                            </div>
                            <div class="offcanvas_menu_wrapper">
                            <div class="top_right">
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="my-account.php"><?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
                    <li><a href="logout.php">Đăng xuất</a></li>
                <?php else: ?>
                    <li><a href="login.php">Đăng nhập/Đăng ký</a></li>
                <?php endif; ?>
            </ul>
        </div>
        </div>
    </div>
    </body>