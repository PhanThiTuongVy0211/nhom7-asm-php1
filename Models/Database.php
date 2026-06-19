<?php
class Database
{
    private $db_host = "103.57.220.210";
    private $db_name = "gtpixbirhosting_lethikieunguyen";
    private $db_user = "gtpixbirhosting_lethikieunguyen";
    private $db_pass = "tP1A%7qX<V#`rW0";
    private $pdo = null; 
    public function connect()
    {
       
        if ($this->pdo !== null) {
            return $this->pdo;
        }

        $dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8";
        try {
           
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            $this->pdo = new PDO($dsn, $this->db_user, $this->db_pass, $options);
            return $this->pdo;
        } catch (Exception $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        try {
            $db = $this->connect(); 
            $stmt = $db->prepare($sql); 
            $stmt->execute($params);
           
            if (strpos(strtoupper($sql), 'SELECT') === 0) {
                return $stmt->fetchAll();
            }

    
            return $stmt->rowCount();
        } catch (PDOException $e) {
            die("Lỗi thực thi SQL: " . $e->getMessage());
        }
    }
}