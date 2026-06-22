<?php
require_once 'Database.php';

class Category
{
    private $db;
    private $table = 'categories';

    public function __construct()
    {
        // ĐỒNG BỘ: Sử dụng lớp Database tập trung để tránh xung đột MySQLi và PDO
        $this->db = new Database();
    }

    // Lấy tất cả danh mục
    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $result = $this->db->query($sql);
        return $result ? $result : [];
    }

    // Lấy danh mục theo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $result = $this->db->query($sql, ['id' => $id]);
        return $result ? $result[0] : null;
    }

    // Thêm danh mục mới
    public function insert($data)
    {
        if (empty($data['name'])) {
            return false;
        }

        $name = trim($data['name']);
        $description = isset($data['description']) ? trim($data['description']) : '';
        $status = isset($data['status']) ? (int) $data['status'] : 1;

        $sql = "INSERT INTO {$this->table} (name, description, status, created_at) 
                VALUES (:name, :description, :status, NOW())";

        // Sử dụng hàm query chuẩn của Database.php để thực thi dữ liệu an toàn
        return $this->db->query($sql, [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ]);
    }

    // Cập nhật danh mục
    public function update($id, $data)
    {
        if (empty($data['name'])) {
            return false;
        }

        $name = trim($data['name']);
        $description = isset($data['description']) ? trim($data['description']) : '';
        $status = isset($data['status']) ? (int) $data['status'] : 1;

        $sql = "UPDATE {$this->table} 
                SET name = :name, 
                    description = :description, 
                    status = :status, 
                    updated_at = NOW() 
                WHERE id = :id";

        return $this->db->query($sql, [
            'name' => $name,
            'description' => $description,
            'status' => $status,
            'id' => $id
        ]);
    }

    // Xóa danh mục
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->db->query($sql, ['id' => $id]);
    }

    // Lấy danh mục đang hiển thị
    public function getActive()
    {
        $sql = "SELECT * FROM {$this->table} WHERE status = 1 ORDER BY name ASC";
        $result = $this->db->query($sql);
        return $result ? $result : [];
    }

    // Đếm số sản phẩm thuộc danh mục
    public function countProducts($id)
    {
        $sql = "SELECT COUNT(*) AS total FROM products WHERE category_id = :id";
        $result = $this->db->query($sql, ['id' => $id]);

        if ($result && isset($result[0]['total'])) {
            return (int) $result[0]['total'];
        }

        return 0;
    }
}