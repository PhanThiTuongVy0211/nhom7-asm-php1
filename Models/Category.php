<?php
require_once __DIR__ . '/../config/database.php';

class Category {
    private $conn;
    private $table = 'categories';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection(); // Hết gạch đỏ vì tên hàm đã khớp
    }

    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => (int)$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function insert($data) {
        $name        = trim($data['name']);
        $description = trim($data['description'] ?? '');
        $status      = isset($data['status']) ? (int)$data['status'] : 1;

        $sql = "INSERT INTO {$this->table} (name, description, status, created_at)
                VALUES (:name, :description, :status, NOW())";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'name'        => $name,
            'description' => $description,
            'status'      => $status
        ]);
    }

    public function update($id, $data) {
        $name        = trim($data['name']);
        $description = trim($data['description'] ?? '');
        $status      = isset($data['status']) ? (int)$data['status'] : 1;

        $sql = "UPDATE {$this->table}
                SET name = :name,
                    description = :description,
                    status = :status,
                    updated_at = NOW()
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'name'        => $name,
            'description' => $description,
            'status'      => $status,
            'id'          => (int)$id
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => (int)$id]);
    }

    public function getActive() {
        $sql = "SELECT * FROM {$this->table} WHERE status = 1 ORDER BY name ASC";
        $stmt = $this->conn->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function countProducts($id) {
        $sql = "SELECT COUNT(*) as total FROM products WHERE category_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => (int)$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['total'] : 0;
    }
}