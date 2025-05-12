<?php
require_once 'config-database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['color_id'])) {
    $product_id = (int)$_POST['product_id'];
    $color_id = (int)$_POST['color_id'];

    if ($product_id > 0 && $color_id > 0) {
        $stmt = $conn->prepare("
            SELECT s.id, s.size, psc.quantity
            FROM size s
            JOIN products_size_color psc ON s.id = psc.id_size
            WHERE psc.id_product = ? AND psc.id_color = ?
        ");
        $stmt->bind_param("ii", $product_id, $color_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $sizes = [];
        $quantity = 0;
        while ($row = $result->fetch_assoc()) {
            $sizes[] = [
                'id' => $row['id'],
                'size' => $row['size']
            ];
            $quantity = (int)$row['quantity']; // Lấy số lượng của kích cỡ đầu tiên
        }
        $stmt->close();

        echo json_encode([
            'sizes' => $sizes,
            'quantity' => $quantity
        ]);
    } else {
        echo json_encode([
            'sizes' => [],
            'quantity' => 0,
            'error' => 'Invalid product_id or color_id'
        ]);
    }
} else {
    echo json_encode([
        'sizes' => [],
        'quantity' => 0,
        'error' => 'Invalid request'
    ]);
}

$conn->close();
?>