<?php

require_once "Database.php";

class Customer
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection(); 
    }

    public function getAll()
    {
        $sql = "SELECT * FROM users WHERE role = 'user'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([':id' => $id]); 
    }

    public function search($keyword)
    {
        $sql = "SELECT * FROM users 
                WHERE (fullname LIKE :keyword 
                OR email LIKE :keyword 
                OR phone LIKE :keyword)
                AND role = 'user'"; 
                
        $stmt = $this->db->prepare($sql);
        
        $searchParam = "%" . $keyword . "%";
        $stmt->execute([':keyword' => $searchParam]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}