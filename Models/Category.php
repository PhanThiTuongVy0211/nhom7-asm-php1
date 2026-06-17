<?php
require_once __DIR__ . '/../config/database.php';

class Category {
    private $conn;
    private $table = 'categories';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lấy tất cả danh mục
    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $result = $this->conn->query($sql);

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Lấy danh mục theo ID
    public function getById($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE id = ? LIMIT 1"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result ? $result->fetch_assoc() : null;
    }

    // Thêm danh mục
    public function insert($data) {

        if (empty($data['name'])) {
            return false;
        }

        $name = trim($data['name']);
        $description = isset($data['description'])
            ? trim($data['description'])
            : '';

        $status = isset($data['status'])
            ? (int)$data['status']
            : 1;

        $stmt = $this->conn->prepare(
            "INSERT INTO {$this->table}
            (name, description, status, created_at)
            VALUES (?, ?, ?, NOW())"
        );

        $stmt->bind_param(
            "ssi",
            $name,
            $description,
            $status
        );

        return $stmt->execute();
    }

    // Cập nhật danh mục
    public function update($id, $data) {

        if (empty($data['name'])) {
            return false;
        }

        $name = trim($data['name']);

        $description = isset($data['description'])
            ? trim($data['description'])
            : '';

        $status = isset($data['status'])
            ? (int)$data['status']
            : 1;

        $stmt = $this->conn->prepare(
            "UPDATE {$this->table}
             SET name = ?,
                 description = ?,
                 status = ?,
                 updated_at = NOW()
             WHERE id = ?"
        );

        $stmt->bind_param(
            "ssii",
            $name,
            $description,
            $status,
            $id
        );

        return $stmt->execute();
    }

    // Xóa danh mục
    public function delete($id) {

        $stmt = $this->conn->prepare(
            "DELETE FROM {$this->table} WHERE id = ?"
        );

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    // Lấy danh mục đang hiển thị
    public function getActive() {

        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table}
             WHERE status = 1
             ORDER BY name ASC"
        );

        $stmt->execute();

        $result = $stmt->get_result();

        return $result
            ? $result->fetch_all(MYSQLI_ASSOC)
            : [];
    }

    // Đếm số sản phẩm theo danh mục
    public function countProducts($id) {

        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) AS total
             FROM products
             WHERE category_id = ?"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $row['total'];
        }

        return 0;
    }
}
