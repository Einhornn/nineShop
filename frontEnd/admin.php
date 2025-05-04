<?php
// session_start();
// if (!isset($_SESSION['admin_id'])) {
//     header('Location: login.php');
//     exit;
// }

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothingshop (1)";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES 'utf8mb4'");
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}

// Xử lý trang hiển thị
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
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

    <!-- Inline CSS để tùy chỉnh giao diện -->
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

        /* Style cho các ô chọn */
        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #ff6a28; /* Màu sắc của checkbox */
            border-radius: 4px;
        }

        /* Hiệu ứng hover cho ô chọn */
        input[type="checkbox"]:hover {
            transform: scale(1.1);
            transition: transform 0.2s ease;
        }

        /* Hiệu ứng hover cho các liên kết trong bảng */
        .action-buttons a {
            color: #ff6a28;
            margin-right: 10px;
            text-decoration: none;
        }

        .action-buttons a:hover {
            text-decoration: underline;
        }

        /* Responsive design cho màn hình nhỏ */
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

        /* Responsive cho các màn hình rất nhỏ */
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
        <h2><a href = "admin.php">Admin</a></h2>
        <ul>
            <li>
                <a href="?page=staff" class="menu-toggle">Quản lý nhân viên</a>
                <ul>
                    <li><a href="?page=staff">Danh sách nhân viên</a></li>
                    <li><a href="?page=staff_accounts">Tài khoản nhân viên</a></li>
                    <li><a href="?page=staff_activity">Lịch sử hoạt động</a></li>
                </ul>
            </li>
            <li>
                <a href="?page=customers" class="menu-toggle">Quản lý khách hàng</a>
                <ul>
                    <li><a href="?page=customers">Danh sách khách hàng</a></li>
                    <li><a href="?page=customer_orders">Lịch sử mua hàng</a></li>
                    <li><a href="?page=customer_types">Phân loại khách hàng</a></li>
                </ul>
            </li>
            <li>
                <a href="?page=products" class="menu-toggle">Quản lý hàng</a>
                <ul>
                    <li><a href="?page=products">Danh sách sản phẩm</a></li>
                    <li><a href="?page=inventory_receipts">Nhập hàng</a></li>
                    <li><a href="?page=price_updates">Cập nhật giá</a></li>
                    <li><a href="?page=inventory">Quản lý kho</a></li>
                    <li><a href="?page=suppliers">Nhà cung cấp</a></li>
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
                    <!-- <li><a href="?page=permissions">Quyền truy cập</a></li>
                    <li><a href="?page=role_logs">Nhật ký quyền</a></li> -->
                </ul>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <?php if ($page == 'dashboard'): ?>
            <!-- <h1>Bảng điều khiển Admin</h1>
            <div class="table-container">
                <h2>Tổng quan</h2>
                <p>Chọn một mục từ menu bên trái để bắt đầu quản lý cửa hàng quần áo nam.</p>
            </div>  -->

            <?php elseif ($page == 'staff'): ?>
    <h1>Danh sách nhân viên</h1>
    <div class="table-container">
        <!-- Thanh tìm kiếm -->
        <div class="search-container">
            <input type="text" id="search-name" placeholder="Tìm theo tên nhân viên...">
            <input type="text" id="search-code" placeholder="Tìm theo mã nhân viên...">
        </div>

        <table id="staff-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã nhân viên</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT id, employee_code, name, email, phone, address FROM employees");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['employee_code']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<a href='edit_staff.php?id=" . $row['id'] . "' class='btn-edit'>Sửa</a>";
                    echo "<a href='delete_staff.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"Xóa nhân viên này?\")'>Xóa</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
           <!-- Script tìm kiếm -->
    <script>
        document.getElementById('search-name').addEventListener('input', filterTable);
        document.getElementById('search-code').addEventListener('input', filterTable);

        function filterTable() {
            const nameInput = document.getElementById('search-name').value.toLowerCase();
            const codeInput = document.getElementById('search-code').value.toLowerCase();
            const table = document.getElementById('staff-table');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const nameCell = rows[i].getElementsByTagName('td')[2]; // Cột Tên
                const codeCell = rows[i].getElementsByTagName('td')[1]; // Cột Mã nhân viên
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
                        $stmt = $conn->query("SELECT u.id, u.name, u.email, u.created_at, r.name AS role_name
                                              FROM users u
                                              LEFT JOIN user_roles ur ON u.id = ur.user_id
                                              LEFT JOIN roles r ON ur.role_id = r.id
                                              WHERE u.id IN (SELECT user_id FROM user_roles)");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['role_name'] ?: 'Chưa phân vai trò') . "</td>";
                            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                            echo "<td class='action-buttons'>";
                            echo "<a href='edit_staff_account.php?id=" . $row['id'] . "'>Sửa</a>";
                            echo "<a href='delete_staff_account.php?id=" . $row['id'] . "' onclick='return confirm(\"Xóa tài khoản này?\")'>Xóa</a>";
                            echo "</td>";
                            echo "</tr>";
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
                        // Tạm thời dùng inventory_receipts để hiển thị hoạt động nhập hàng
                        $stmt = $conn->query("SELECT ir.id, u.name AS user_name, ir.received_at, ir.notes
                                              FROM inventory_receipts ir
                                              JOIN users u ON ir.user_id = u.id");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                            echo "<td>Nhập hàng</td>";
                            echo "<td>" . htmlspecialchars($row['received_at']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['notes'] ?: 'Không có ghi chú') . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <p>Lưu ý: Hiện chỉ hiển thị hoạt động nhập hàng. Cần thêm bảng activity_logs để theo dõi đầy đủ.</p>
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
                        $stmt = $conn->query("SELECT id, name, email, phone, address FROM users");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
                        $stmt = $conn->query("SELECT o.id, u.name AS user_name, o.total_amount, o.status, o.created_at
                                              FROM orders o
                                              JOIN users u ON o.user_id = u.id");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
                        $stmt = $conn->query("SELECT u.id, u.name, u.email,
                                              COUNT(o.id) AS order_count,
                                              SUM(o.total_amount) AS total_spent
                                              FROM users u
                                              LEFT JOIN orders o ON u.id = o.user_id
                                              GROUP BY u.id");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
                        ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($page == 'products'): ?>
            <h1>Danh sách sản phẩm</h1>
            <div class="table-container">
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
                        $stmt = $conn->query("SELECT p.id, p.name, p.price, p.stock, p.image_url, s.name AS subcategory
                                              FROM products p
                                              JOIN subcategories s ON p.subcategories_id = s.id");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['subcategory']) . "</td>";
                            echo "<td>" . number_format($row['price'], 0, ',', '.') . " VNĐ</td>";
                            echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
                            echo "<td><img src='" . htmlspecialchars($row['image_url']) . "' alt='Product' style='max-width: 50px;'></td>";
                            echo "<td class='action-buttons'>";
                            echo "<a href='edit_product.php?id=" . $row['id'] . "'>Sửa</a>";
                            echo "<a href='delete_product.php?id=" . $row['id'] . "' onclick='return confirm(\"Xóa sản phẩm này?\")'>Xóa</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

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
                        $stmt = $conn->query("SELECT ir.id, u.name AS user_name, ir.received_at, ir.status, ir.notes
                                              FROM inventory_receipts ir
                                              JOIN users u ON ir.user_id = u.id");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
                        $stmt = $conn->query("SELECT o.id, u.name AS user_name, o.total_amount, o.status, o.created_at
                                              FROM orders o
                                              JOIN users u ON o.user_id = u.id");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
                            echo "<td>" . number_format($row['total_amount'], 0, ',', '.') . " VNĐ</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                            echo "</tr>";
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
                        $stmt = $conn->query("SELECT p.id, p.name, s.name AS subcategory,
                                              SUM(oi.quantity) AS total_sold, p.stock
                                              FROM products p
                                              JOIN subcategories s ON p.subcategories_id = s.id
                                              LEFT JOIN order_items oi ON p.id = oi.product_id
                                              GROUP BY p.id");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['subcategory']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['total_sold'] ?: 0) . "</td>";
                            echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
                            echo "<td class='action-buttons'>";
                            echo "<a href='view_product.php?id=" . $row['id'] . "'>Xem</a>";
                            echo "</td>";
                            echo "</tr>";
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
                        $stmt = $conn->query("SELECT u.id, u.name, u.email,
                                              COUNT(o.id) AS order_count,
                                              SUM(o.total_amount) AS total_spent
                                              FROM users u
                                              LEFT JOIN orders o ON u.id = o.user_id
                                              GROUP BY u.id
                                              ORDER BY total_spent DESC");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
        </div>
        <table id="roles-table">

            <thead>
                <tr>
                    <th>Tên nhân viên</th>
                    <th>Mã nhân viên</th>
                    <?php
                    // Giả lập danh sách quyền (có thể lấy từ cơ sở dữ liệu)
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
                $stmt = $conn->query("
                    SELECT e.id, e.name AS employee_name, e.employee_code, r.id AS role_id, r.name AS role_name
                    FROM employees e
                    LEFT JOIN user_roles ur ON e.id = ur.user_id
                    LEFT JOIN roles r ON ur.role_id = r.id
                ");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['employee_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['employee_code']) . "</td>";
                    // Tạo ô chọn cho mỗi quyền
                    // Lấy danh sách permission đã được gán cho nhân viên này
                    $permStmt = $conn->prepare("SELECT permission_id FROM role_permissions WHERE role_id = ?");
                    $permStmt->execute([$row['role_id']]);
                    $grantedPermissions = $permStmt->fetchAll(PDO::FETCH_COLUMN);

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

            for (let i = 1; i < rows.length; i++) { // Bắt đầu từ 1 để bỏ qua hàng tiêu đề
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
    <!-- Inline JS để xử lý click mở/đóng menu -->
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
    <script>
function confirmReset() {
    if (confirm('Bạn có chắc muốn đặt lại phân quyền không?')) {
        location.reload()
    }
}
</script>
<script>
// function savePermissions() {
//     const formData = new FormData(document.getElementById("permissionForm"));

//     fetch("update_permission.php", {
//         method: "POST",
//         body: formData
//     })
//     .then(res => res.text())
//     .then(data => {
//         if (data.trim() === "OK") {
//             document.getElementById("saveAlert").style.display = "inline-block"
//             setTimeout(() => {
//                 document.getElementById("saveAlert").style.display = "none"
//                 location.reload()
//             }, 1500)
//         } else {
//             alert("Có lỗi xảy ra: " + data)
//         }
//     })
//     .catch(err => {
//         console.error(err);
//         alert("Đã xảy ra lỗi khi lưu phân quyền.")
//     });
// }
function savePermissions() {
    const permissions = [];
    
    // Lấy tất cả các checkbox trong bảng
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

    // Gửi dữ liệu lên server
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
<script>
function savePermissions() {
    const formData = new FormData(document.getElementById("permissionForm"));

    fetch("update_permission.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        alert("Lưu phân quyền thành công!")
        location.reload();
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