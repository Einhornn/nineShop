<?php
require_once '../config-database.php';
session_start();

// Kiểm tra ID sản phẩm
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['product_error'] = "ID sản phẩm không hợp lệ.";
    header("Location: ../../frontEnd/admin.php?page=products");
    exit();
}

$product_id = (int)$_GET['id'];

// Lấy thông tin sản phẩm
$stmt = $conn->prepare("
    SELECT psc.id, p.name, p.subcategories_id, p.description, p.price, p.image_url_1, psc.id_size, psc.id_color, psc.quantity
    FROM products p
    JOIN subcategories s ON p.subcategories_id = s.id
    JOIN products_size_color psc ON p.id = psc.id_product
    WHERE psc.id = ?
");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    $_SESSION['product_error'] = "Sản phẩm không tồn tại.";
    header("Location: ../../frontEnd/admin.php?page=products");
    exit();
}
$product = $result->fetch_assoc();
$stmt->close();

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sửa Sản Phẩm - Quản lý bán quần áo nam</title>
    <meta name="description" content="Trang sửa thông tin sản phẩm">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/jpg" href="../img/logo/2.icon.png">
    <link rel="stylesheet" href="../css/plugins.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: "Libre Franklin", sans-serif;
            background: #ffffff;
            color: #242424;
        }
        .main-content {
            margin-left: 220px;
            padding: 20px;
            min-height: 100vh;
            background: #ffffff;
        }
        .edit-product-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
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
        .current-image {
            max-width: 100px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <h1>Sửa Sản Phẩm</h1>
        <div class="edit-product-form">
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
            <form action="process-edit-product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <div class="form-group">
                    <label for="name">Tên Sản Phẩm <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="subcategory">Danh Mục Con <span class="text-danger">*</span></label>
                    <select name="subcategory" id="subcategory" required>
                        <option value="">Chọn danh mục</option>
                        <?php
                        $result = $conn->query("SELECT id, name FROM subcategories");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                $selected = ($row['id'] == $product['subcategories_id']) ? 'selected' : '';
                                echo "<option value='" . $row['id'] . "' $selected>" . htmlspecialchars($row['name']) . "</option>";
                            }
                            $result->free();
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Mô Tả</label>
                    <textarea name="description" id="description"><?php echo htmlspecialchars($product['description']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Giá (VNĐ) <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="price" step="1000" min="0" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="image">Hình Ảnh</label>
                    <input type="file" name="image" id="image" accept=".jpg,.png">
                    <?php if ($product['image_url_1']): ?>
                        <div>
                            <p>Hình ảnh hiện tại:</p>
                            <img src="<?php echo htmlspecialchars($product['image_url_1']); ?>" alt="Product Image" class="current-image">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="size">Kích Thước <span class="text-danger">*</span></label>
                    <select name="size" id="size" required>
                        <option value="">Chọn kích thước</option>
                        <?php
                        $result = $conn->query("SELECT id, size FROM size");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                $selected = ($row['id'] == $product['id_size']) ? 'selected' : '';
                                echo "<option value='" . $row['id'] . "' $selected>" . htmlspecialchars($row['size']) . "</option>";
                            }
                            $result->free();
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="color">Màu Sắc <span class="text-danger">*</span></label>
                    <select name="color" id="color" required>
                        <option value="">Chọn màu sắc</option>
                        <?php
                        $result = $conn->query("SELECT id, name FROM color");
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                $selected = ($row['id'] == $product['id_color']) ? 'selected' : '';
                                echo "<option value='" . $row['id'] . "' $selected>" . htmlspecialchars($row['name']) . "</option>";
                            }
                            $result->free();
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Số Lượng <span class="text-danger">*</span></label>
                    <input type="number" name="quantity" id="quantity" min="1" value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
                    <a href="../../frontEnd/admin.php?page=products" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('hide');
                }, 3000);
            });
        });
    </script>
</body>
</html>
<?php
$conn->close();
?>