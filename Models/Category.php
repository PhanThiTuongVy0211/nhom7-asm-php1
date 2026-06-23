<?php

class Category {
    private $conn;
    private $table = 'categories';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect(); // FIX: đúng hàm connect()
    }

    // Lấy tất cả danh mục
    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh mục theo ID
    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm danh mục
    public function insert($data) {
        $sql = "INSERT INTO {$this->table} (name, description, status, created_at)
                VALUES (:name, :description, :status, NOW())";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':name' => trim($data['name']),
            ':description' => trim($data['description'] ?? ''),
            ':status' => (int)($data['status'] ?? 1)
        ]);
    }

    // Cập nhật
    public function update($id, $data) {
        $sql = "UPDATE {$this->table}
                SET name = :name,
                    description = :description,
                    status = :status,
                    updated_at = NOW()
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => (int)$id,
            ':name' => trim($data['name']),
            ':description' => trim($data['description'] ?? ''),
            ':status' => (int)($data['status'] ?? 1)
        ]);
    }

    // Xóa
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => (int)$id]);
    }

    // Active categories
    public function getActive() {
        $sql = "SELECT * FROM {$this->table} WHERE status = 1 ORDER BY name ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm sản phẩm
    public function countProducts($id) {
        $sql = "SELECT COUNT(*) FROM products WHERE category_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => (int)$id]);
        return $stmt->fetchColumn();
    }
}