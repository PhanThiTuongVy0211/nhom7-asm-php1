<?php
require_once 'Database.php';

class Product
{
    private $db;

    public function __construct()
    {
       
        $this->db = new Database();
    }

    // Lấy tất cả sản phẩm thời trang mới nhất
    public function getAllProducts()
    {
        $sql = "SELECT * FROM products ORDER BY id DESC";
        return $this->db->query($sql); 
    }

    // Lấy sản phẩm theo danh mục (Ví dụ: Váy, Áo sơ mi, Quần jean...)
    public function getProductsByCategory($category_id)
    {
        $sql = "SELECT * FROM products WHERE category_id = :category_id AND status = 1";
       
        return $this->db->query($sql, ['category_id' => $category_id]);
    }

    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id LIMIT 1";
        $result = $this->db->query($sql, ['id' => $id]);
        return $result ? $result[0] : null;
    }

    public function searchProducts($keyword)
    {
        $sql = "SELECT * FROM products WHERE name LIKE :keyword OR description LIKE :keyword";
        return $this->db->query($sql, ['keyword' => "%$keyword%"]);
    }
}