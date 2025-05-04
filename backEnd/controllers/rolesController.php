<?php
require_once '../config-database.php'; // hoặc đúng đường dẫn bạn đang dùng

class RolesController {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAllEmployees() {
        $query = "SELECT * FROM employee";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRoles() {
        $query = "SELECT * FROM role";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hasRole($user_id, $role_id) {
        $query = "SELECT COUNT(*) FROM user_role WHERE user_id = ? AND role_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $role_id]);
        return $stmt->fetchColumn() > 0;
    }

    public function assignRole($user_id, $role_id) {
        $query = "INSERT IGNORE INTO user_role (user_id, role_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $role_id]);
    }

    public function removeRole($user_id, $role_id) {
        $query = "DELETE FROM user_role WHERE user_id = ? AND role_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $role_id]);
    }
}
