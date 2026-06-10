<?php


class CategoryController {
    private $db;

    public function __construct() {
       
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=ten_database_cua_ban;charset=utf8", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

   
    public function index() {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $categories;
    }

    public function store($name) {
        if (!empty($name)) {
            $sql = "INSERT INTO categories (name) VALUES (:name)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':name' => $name]);
            header("Location: categories.php");
            exit();
        }
    }

  
    public function delete($id) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        header("Location: categories.php");
        exit();
    }
}