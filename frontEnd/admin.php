<?php
session_start();
require_once '../backEnd/config-database.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';


// if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
//     header('Location: login.php');
//     exit();
// }

// $role = $_SESSION['user_role'];
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin - Quản lý bán quần áo nam</title>
    <meta name="description" content="Trang quản lý dành cho admin">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/jpg" href="../assets/img/logo/2.icon.png">
    <link rel="stylesheet" href="../assets/css/plugins.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: "Libre Franklin", sans-serif;
            background: #ffffff;
            color: #242424;
        }

        .header_area {
            background: #ffffff;
            border-bottom: 1px solid #ddd;
        }

        .header_top {
            background: #242424;
            text-align: center;
            padding: 10px 0;
        }

        .header_top p {
            margin: 0;
            color: #ffffff;
            font-size: 12px;
        }

        .header_middel {
            padding: 20px 0;
            display: flex;
            justify-content: center;
        }

        .middel_inner {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo img {
            max-height: 50px;
            max-width: 150px;
            object-fit: contain;
        }

        .sidebar {
            width: 220px;
            background: #242424;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            border-right: 1px solid #ddd;
            transition: width 0.3s ease;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 1.4rem;
            margin-bottom: 20px;
            color: #ffffff;
            font-weight: 500;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 12px 20px;
        }

        .sidebar ul li a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            font-size: 0.95rem;
            font-weight: 400;
        }

        .sidebar ul li a:hover {
            background: #333333;
            border-radius: 4px;
            color: #ff6a28;
        }

        .sidebar ul ul {
            margin-left: 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .sidebar ul li.active ul {
            max-height: 200px;
        }

        .sidebar ul ul li a {
            font-size: 0.85rem;
            color: #a9a9a9;
        }

        .sidebar.toggle {
            width: 80px;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
            min-height: 100vh;
            background: #ffffff;
            transition: margin-left 0.3s ease;
        }

        .main-content h1 {
            font-size: 30px;
            font-weight: 500;
            margin-bottom: 20px;
            color: #242424;
        }

        .table-container {
            background: #f6f6f6;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            color: #242424;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #242424;
            color: #ffffff;
            font-weight: 500;
        }

        tr:hover {
            background: #e6e6e6;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #ff6a28; 
            border-radius: 4px;
        }

        input[type="checkbox"]:hover {
            transform: scale(1.1);
            transition: transform 0.2s ease;
        }

        .action-buttons a {
            color: #ff6a28;
            margin-right: 10px;
            text-decoration: none;
        }

        .action-buttons a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 180px;
            }
            .main-content {
                margin-left: 180px;
            }
            .logo img {
                max-width: 120px;
            }
            table {
                font-size: 12px;
            }
            th, td {
                padding: 8px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.toggle {
                display: block;
                width: 100%;
                position: absolute;
                background: #242424;
                top: 0;
                left: 0;
                z-index: 100;
            }
        }
        .permission-header {
            position: relative;
            cursor: pointer;
        }

        .permission-header:hover::after {
            content: attr(data-description);
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #333;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 10;
        }
        .search-container input {
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .search-container input:focus {
            outline: none;
            border-color: #ff6a28;
            box-shadow: 0 0 5px rgba(255, 106, 40, 0.3);
        }

        .add-product-form {
            display: none;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .add-product-form.active {
            display: block;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form-group select[multiple] {
            height: 100px;
        }
        .form-group input[type="file"] {
            padding: 5px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 1em;
            position: relative;
            opacity: 0;
            transform: translateY(-10px);
            animation: fadeIn 0.5s ease-in-out forwards;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateY(-10px);
                display: none;
            }
        }
        .alert.hide {
            animation: fadeOut 0.5s ease-in-out forwards;
        }
    </style>
</head>

<body>
    <header class="header_area header_three">
        <div class="header_top">
            <div class="header_center">
                <p>Chào mừng đến trang Admin</p>
            </div>
        </div>
        <div class="header_middel">
            <div class="container-fluid">
                <div class="middel_inner">
                    <div class="logo">
                        <a href="admin.php"><img src="../assets/img/logo/1.logo.jpg" alt="Logo"></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2><a href="admin.php">Admin</a></h2>
        <ul>
            <li>
                <a href="?page=users" class="menu-toggle">Quản lý người dùng</a>
                <ul>
                    <li><a href="?page=users">Danh sách người dùng</a></li>
                </ul>
            </li>
            <li>
                <a href="?page=products" class="menu-toggle">Quản lý hàng</a>
                <ul>
                    <li><a href="?page=products">Danh sách sản phẩm</a></li>
                </ul>
            </li>
            <li>
                <a href="?page=statistics" class="menu-toggle">Thống kê</a>
                <ul>
                    <li><a href="?page=statistics_revenue">Doanh thu</a></li>
                    <li><a href="?page=statistics_products">Sản phẩm</a></li>
                    <li><a href="?page=statistics_customers">Khách hàng</a></li>
                    <li><a href="?page=statistics_reports">Xuất báo cáo</a></li>
                </ul>
            </li>
            <li>
                <a href="?page=roles" class="menu-toggle">Quản lý quyền</a>
                <ul>
                    <li><a href="?page=roles">Phân quyền</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <?php if ($page == 'dashboard'): ?>
            <h1>Bảng điều khiển Admin</h1>
            <div class="table-container">
                <h2>Tổng quan</h2>
                <p>Chọn một mục từ menu bên trái để bắt đầu quản lý cửa hàng quần áo nam.</p>
            </div>

        <?php elseif ($page == 'users'): ?>
        <h1>Danh sách người dùng</h1>

        <!-- Nút thêm -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success" onclick="toggleAddUserForm()">Thêm người dùng</button>
        </div>

        <!-- Form thêm người dùng -->
        <div class="add-user-form" id="addUserForm" style="display: none;">
            <h2>Thêm người dùng</h2>
            <?php if (isset($_SESSION['user_error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['user_error']; unset($_SESSION['user_error']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['user_success']; unset($_SESSION['user_success']); ?></div>
            <?php endif; ?>
            <form action="../backEnd/add-user.php" method="POST">
                <div class="form-group">
                    <label>Họ tên <span class="text-danger">*</span></label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Mật khẩu <span class="text-danger">*</span></label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Điện thoại</label>
                    <input type="text" name="phone">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                    <button type="button" class="btn btn-secondary" onclick="toggleAddUserForm()">Huỷ</button>
                </div>
            </form>
        </div>

        <!-- Danh sách -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th><th>Họ tên</th><th>Email</th><th>Điện thoại</th><th>Địa chỉ</th><th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users = $conn->query("SELECT * FROM users");
                while ($user = $users->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['phone']) ?></td>
                    <td><?= htmlspecialchars($user['address']) ?></td>
                    <td>
                        <a href="#" onclick="openEditForm(<?= htmlspecialchars(json_encode($user)) ?>)">Sửa</a> |
                        <a href="backEnd/user/delete-user.php?id=<?= $user['id'] ?>" onclick="return confirm('Xoá người dùng này?')">Xoá</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Form sửa -->
        <div class="edit-user-form" id="editUserForm" style="display: none;">
            <h2>Sửa người dùng</h2>
            <form action="../backEnd/user/edit-user.php" method="POST">
                <input type="hidden" name="id" id="edit_id">
                <div class="form-group">
                    <label>Họ tên</label>
                    <input type="text" name="name" id="edit_name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="edit_email" required>
                </div>
                <div class="form-group">
                    <label>Điện thoại</label>
                    <input type="text" name="phone" id="edit_phone">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" id="edit_address">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning">Cập nhật</button>
                    <button type="button" class="btn btn-secondary" onclick="toggleEditUserForm()">Huỷ</button>
                </div>
            </form>
        </div>

        <!-- Script -->
        <script>
        function toggleAddUserForm() {
            document.getElementById('addUserForm').style.display =
                document.getElementById('addUserForm').style.display === 'none' ? 'block' : 'none';
        }

        function toggleEditUserForm() {
            document.getElementById('editUserForm').style.display =
                document.getElementById('editUserForm').style.display === 'none' ? 'block' : 'none';
        }

        function openEditForm(user) {
            toggleEditUserForm();
            document.getElementById('edit_id').value = user.id;
            document.getElementById('edit_name').value = user.name;
            document.getElementById('edit_email').value = user.email;
            document.getElementById('edit_phone').value = user.phone;
            document.getElementById('edit_address').value = user.address;
        }
        </script>


        <?php elseif ($page == 'staff_accounts'): ?>
            <h1>Tài khoản nhân viên</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT u.id, u.name, u.email, u.created_at, r.name AS role_name
                                              FROM users u
                                              LEFT JOIN user_roles ur ON u.id = ur.user_id
                                              LEFT JOIN roles r ON ur.role_id = r.id
                                              WHERE u.id IN (SELECT user_id FROM user_roles)");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['role_name'] ?: 'Chưa phân vai trò') . "</td>";
                                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                echo "<td class='action-buttons'>";
                                echo '<a href="../backEnd/user/edit-user.php?id=' . $row['id'] . '">Sửa</a>';
                                echo '<a href="../backEnd/user/delete-user.php?id=' . $row['id'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xoá không?\')">Xoá</a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($page == 'staff_activity'): ?>
            <h1>Lịch sử hoạt động</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nhân viên</th>
                            <th>Hành động</th>
                            <th>Ngày thực hiện</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT ir.id, u.name AS user_name, ir.received_at, ir.notes
                                              FROM inventory_receipts ir
                                              JOIN users u ON ir.user_id = u.id");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                                echo "<td>Nhập hàng</td>";
                                echo "<td>" . htmlspecialchars($row['received_at']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['notes'] ?: 'Không có ghi chú') . "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        }
                        ?>
                    </tbody>
                </table>
                <!-- <p>Lưu ý: Hiện chỉ hiển thị hoạt động nhập hàng. Cần thêm bảng activity_logs để theo dõi đầy đủ.</p> -->
            </div>

        <?php elseif ($page == 'customers'): ?>
            <h1>Danh sách khách hàng</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT id, name, email, phone, address FROM users");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                echo "<td class='action-buttons'>";
                                echo "<a href='view_customer.php?id=" . $row['id'] . "'>Xem</a>";
                                echo "<a href='edit_customer.php?id=" . $row['id'] . "'>Sửa</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($page == 'customer_orders'): ?>
            <h1>Lịch sử mua hàng</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID Đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT o.id, u.name AS user_name, o.total_amount, o.status, o.created_at
                                              FROM orders o
                                              JOIN users u ON o.user_id = u.id");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                                echo "<td>" . number_format($row['total_amount'], 0, ',', '.') . " VNĐ</td>";
                                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                echo "<td class='action-buttons'>";
                                echo "<a href='view_order.php?id=" . $row['id'] . "'>Xem chi tiết</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($page == 'customer_types'): ?>
            <h1>Phân loại khách hàng</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số đơn hàng</th>
                            <th>Tổng chi tiêu</th>
                            <th>Loại</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT u.id, u.name, u.email,
                                              COUNT(o.id) AS order_count,
                                              SUM(o.total_amount) AS total_spent
                                              FROM users u
                                              LEFT JOIN orders o ON u.id = o.user_id
                                              GROUP BY u.id");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                $type = ($row['total_spent'] > 1000000) ? 'VIP' : 'Thường';
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['order_count']) . "</td>";
                                echo "<td>" . number_format($row['total_spent'] ?: 0, 0, ',', '.') . " VNĐ</td>";
                                echo "<td>" . $type . "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($page == 'products'): ?>
            <h1>Danh sách sản phẩm</h1>
            <div class="table-container">
                <!-- Nút thêm sản phẩm -->
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-success" onclick="toggleAddProductForm()">Thêm sản phẩm</button>
                </div>

                <div class="add-product-form" id="addProductForm">
                    <h2>Thêm sản phẩm mới</h2>
                    <?php if (isset($_SESSION['product_error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($_SESSION['product_error']); unset($_SESSION['product_error']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['product_success'])): ?>
                        <div class="alert alert-success">
                            <?php echo htmlspecialchars($_SESSION['product_success']); unset($_SESSION['product_success']); ?>
                        </div>
                    <?php endif; ?>
                    <form action="../backEnd/add-product.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="subcategory">Danh mục con <span class="text-danger">*</span></label>
                            <select name="subcategory" id="subcategory" required>
                                <option value="">Chọn danh mục</option>
                                <?php
                                $result = $conn->query("SELECT id, name FROM subcategories");
                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                    }
                                    $result->free();
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea name="description" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá (VNĐ) <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" step="1000" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Hình ảnh <span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" accept=".jpg,.png" required>
                        </div>
                        <div class="form-group">
                            <label for="sizes">Kích thước <span class="text-danger">*</span></label>
                            <select name="sizes[]" id="sizes" multiple required>
                                <?php
                                $result = $conn->query("SELECT id, size FROM size");
                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['size']) . "</option>";
                                    }
                                    $result->free();
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="colors">Màu sắc <span class="text-danger">*</span></label>
                            <select name="colors[]" id="colors" multiple required>
                                <?php
                                $result = $conn->query("SELECT id, name FROM color");
                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                                    }
                                    $result->free();
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Số lượng <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" id="quantity" min="1" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                            <button type="button" class="btn btn-secondary" onclick="toggleAddProductForm()">Hủy</button>
                        </div>
                    </form>
                </div>

                <!-- Danh sách sản phẩm -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Kho</th>
                            <th>Hình ảnh</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT psc.id, p.name, s.name AS subcategory, p.price, psc.quantity, p.image_url_1 
                                              FROM products p
                                              JOIN subcategories s ON p.subcategories_id = s.id
                                              JOIN products_size_color psc ON p.id = psc.id_product");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['subcategory']) . "</td>";
                                echo "<td>" . number_format($row['price'], 0, ',', '.') . " VNĐ</td>";
                                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                                echo "<td><img src='" . htmlspecialchars($row['image_url_1']) . "' alt='Product' style='max-width: 50px;'></td>";
                                echo "<td class='action-buttons'>";
                                echo "<a href='../backEnd/product/edit-product.php?id=" . $row['id'] . "'>Sửa</a>";
                                echo "<a href='../backEnd/product/delete-product.php?id=" . $row['id'] . "' onclick='return confirm(\"Xóa sản phẩm này?\")'>Xóa</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Script hiển thị/ẩn form -->
            <script>
                function toggleAddProductForm() {
                    const form = document.getElementById('addProductForm');
                    form.classList.toggle('active');
                }

                document.addEventListener('DOMContentLoaded', function () {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(alert => {
                        setTimeout(() => {
                            alert.classList.add('hide');
                        }, 3000); // Ẩn sau 3 giây
                    });
                });
            </script>

        <?php elseif ($page == 'inventory_receipts'): ?>
            <h1>Nhập hàng</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Người nhập</th>
                            <th>Ngày nhập</th>
                            <th>Trạng thái</th>
                            <th>Ghi chú</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT ir.id, u.name AS user_name, ir.received_at, ir.status, ir.notes
                                              FROM inventory_receipts ir
                                              JOIN users u ON ir.user_id = u.id");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['received_at']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['notes']) . "</td>";
                                echo "<td class='action-buttons'>";
                                echo "<a href='view_receipt.php?id=" . $row['id'] . "'>Xem</a>";
                                echo "<a href='edit_receipt.php?id=" . $row['id'] . "'>Sửa</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($page == 'statistics_revenue'): ?>
            <h1>Thống kê doanh thu</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID Đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT o.id, u.name AS user_name, o.total_amount, o.status, o.created_at
                                              FROM orders o
                                              JOIN users u ON o.user_id = u.id");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                                echo "<td>" . number_format($row['total_amount'], 0, ',', '.') . " VNĐ</td>";
                                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($page == 'statistics_products'): ?>
            <h1>Thống kê sản phẩm</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Danh mục</th>
                            <th>Số lượng bán</th>
                            <th>Tồn kho</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT p.id, p.name, s.name AS subcategory,
                                              SUM(oi.quantity) AS total_sold, psc.quantity
                                              FROM products p
                                              JOIN subcategories s ON p.subcategories_id = s.id
                                              LEFT JOIN order_items oi ON p.id = oi.product_id
                                              JOIN products_size_color psc ON p.id = psc.id_product
                                              GROUP BY p.id");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['subcategory']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['total_sold'] ?: 0) . "</td>";
                                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                                echo "<td class='action-buttons'>";
                                echo "<a href='view_product.php?id=" . $row['id'] . "'>Xem</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($page == 'statistics_customers'): ?>
            <h1>Thống kê khách hàng</h1>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số đơn hàng</th>
                            <th>Tổng chi tiêu</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT u.id, u.name, u.email,
                                              COUNT(o.id) AS order_count,
                                              SUM(o.total_amount) AS total_spent
                                              FROM users u
                                              LEFT JOIN orders o ON u.id = o.user_id
                                              GROUP BY u.id
                                              ORDER BY total_spent DESC");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['order_count']) . "</td>";
                                echo "<td>" . number_format($row['total_spent'] ?: 0, 0, ',', '.') . " VNĐ</td>";
                                echo "<td class='action-buttons'>";
                                echo "<a href='view_customer.php?id=" . $row['id'] . "'>Xem</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($page == 'roles'): ?>
            <h1>Phân quyền vai trò</h1>
            <div class="table-container">
                <form id="permissionForm">
                    <!-- Ô tìm kiếm -->
                    <div class="search-container" style="margin-bottom: 20px;">
                        <input type="text" id="search-name" placeholder="Tìm theo tên nhân viên..." style="padding: 8px; width: 200px; margin-right: 10px;">
                        <input type="text" id="search-code" placeholder="Tìm theo mã nhân viên..." style="padding: 8px; width: 200px;">
                    </div>
                    <!-- Container bọc nút -->
                    <div class="d-flex justify-content-end align-items-center mb-3 gap-2">
                        <div id="saveAlert" class="alert alert-success py-1 px-3 mb-0" style="display:none;">
                            Đã lưu phân quyền
                        </div>
                        <button type="button" onclick="savePermissions()" class="btn btn-success">
                            Lưu phân quyền
                        </button>
                        <button type="button" onclick="confirmReset()" class="btn btn-secondary">
                            Đặt lại
                        </button>
                    </div>
                </form>
                <table id="roles-table">
                    <thead>
                        <tr>
                            <th>Tên nhân viên</th>
                            <th>email</th>
                            <?php
                            $permissions = [
                                1 => ['name' => 'Quyền thêm hàng', 'description' => 'Cho phép thêm sản phẩm vào kho'],
                                2 => ['name' => 'Quyền xem báo cáo', 'description' => 'Xem báo cáo doanh thu và thống kê'],
                                3 => ['name' => 'Quyền sửa sản phẩm', 'description' => 'Sửa thông tin sản phẩm trong kho'],
                                4 => ['name' => 'Quyền xóa đơn hàng', 'description' => 'Xóa đơn hàng của khách']
                            ];
                            foreach ($permissions as $perm_id => $perm) {
                                echo "<th class='permission-header' data-description='" . htmlspecialchars($perm['description']) . "'>" . htmlspecialchars($perm['name']) . "</th>";
                            }
                            ?>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("
                            SELECT u.id, u.name AS employee_name, u.email AS employee_code, r.id AS role_id, r.name AS role_name
                            FROM users u
                            LEFT JOIN user_roles ur ON u.id = ur.user_id
                            LEFT JOIN roles r ON ur.role_id = r.id
                            WHERE u.id IN (SELECT user_id FROM user_roles)
                        ");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['employee_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['employee_code']) . "</td>";
                                $perm_result = $conn->query("SELECT permission_id FROM role_permissions WHERE role_id = " . (int)$row['role_id']);
                                $grantedPermissions = [];
                                if ($perm_result) {
                                    while ($perm_row = $perm_result->fetch_assoc()) {
                                        $grantedPermissions[] = $perm_row['permission_id'];
                                    }
                                    $perm_result->free();
                                }

                                for ($i = 1; $i <= 4; $i++) {
                                    $checked = in_array($i, $grantedPermissions) ? 'checked' : '';
                                    echo "<td><input type='checkbox' class='role-permission' data-employee-id='" . $row['id'] . "' data-permission='" . $i . "' $checked></td>";
                                }

                                echo "<td class='action-buttons'>";
                                echo "<a href='edit_employee_role.php?id=" . $row['id'] . "' class='btn-edit'>Sửa</a>";
                                echo "<a href='delete_employee_role.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Xóa vai trò của nhân viên này?\")'>Xóa</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            $result->free();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Script xử lý tìm kiếm -->
            <script>
                document.getElementById('search-name').addEventListener('input', function() {
                    filterTable();
                });

                document.getElementById('search-code').addEventListener('input', function() {
                    filterTable();
                });

                function filterTable() {
                    const nameInput = document.getElementById('search-name').value.toLowerCase();
                    const codeInput = document.getElementById('search-code').value.toLowerCase();
                    const table = document.getElementById('roles-table');
                    const rows = table.getElementsByTagName('tr');

                    for (let i = 1; i < rows.length; i++) {
                        const nameCell = rows[i].getElementsByTagName('td')[0];
                        const codeCell = rows[i].getElementsByTagName('td')[1];
                        const nameText = nameCell.textContent.toLowerCase();
                        const codeText = codeCell.textContent.toLowerCase();

                        if (nameText.includes(nameInput) && codeText.includes(codeInput)) {
                            rows[i].style.display = '';
                        } else {
                            rows[i].style.display = 'none';
                        }
                    }
                }
            </script>

        <?php else: ?>
            <h1>Trang không tồn tại</h1>
            <div class="table-container">
                <p>Chọn một mục từ menu bên trái để tiếp tục.</p>
            </div>
        <?php endif; ?>
    </div>

    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
    <script>
        document.querySelectorAll('.menu-toggle').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                const parentLi = item.parentElement;
                const isActive = parentLi.classList.contains('active');
                document.querySelectorAll('.sidebar ul li').forEach(li => {
                    li.classList.remove('active');
                });
                if (!isActive) {
                    parentLi.classList.add('active');
                }
            });
        });
    </script>
    <div id="toast" style="display:none; position: fixed; top: 10px; right: 10px; background: #28a745; color: white; padding: 10px 20px; border-radius: 5px; z-index: 9999;"></div>

<script>
    const msg = "<?= $msg ?>";
    if (msg) {
        let text = "";
        switch (msg) {
            case "added": text = "Thêm người dùng thành công"; break;
            case "updated": text = "Cập nhật thành công"; break;
            case "deleted": text = "Xóa thành công"; break;
            case "empty": text = "Vui lòng nhập đầy đủ thông tin"; break;
            case "notfound": text = "Không tìm thấy người dùng"; break;
        }

        const toast = document.getElementById("toast");
        toast.innerText = text;
        toast.style.display = "block";

        setTimeout(() => {
            toast.style.display = "none";
        }, 3000);
    }
</script>

    <script>
        function savePermissions() {
            const permissions = [];
            
            document.querySelectorAll('.role-permission').forEach(checkbox => {
                const employeeId = checkbox.getAttribute('data-employee-id');
                const permissionId = checkbox.getAttribute('data-permission');
                const checked = checkbox.checked ? 1 : 0;
                
                permissions.push({
                    employee_id: employeeId,
                    permission_id: permissionId,
                    checked: checked
                });
            });

            fetch("update_permission.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(permissions)
            })
            .then(res => res.text())
            .then(data => {
                if (data.trim() === "OK") {
                    document.getElementById("saveAlert").style.display = "inline-block";
                    setTimeout(() => {
                        document.getElementById("saveAlert").style.display = "none";
                        location.reload();
                    }, 1500);
                } else {
                    alert("Có lỗi xảy ra: " + data);
                }
            })
            .catch(err => {
                console.error(err);
                alert("Đã xảy ra lỗi khi lưu phân quyền.");
            });
        }

        function confirmReset() {
            if (confirm("Bạn có chắc muốn đặt lại phân quyền không?")) {
                location.reload();
            }
        }
    </script>
</body>
</html>
<?php
$conn->close();
?>