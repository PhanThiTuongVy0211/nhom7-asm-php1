<?php 

class Database {
    private $db_host = "103.57.220.210";
    private $db_name = "gtpixbirhosting_lethikieunguyen";
    private $db_user = "gtpixbirhosting_lethikieunguyen";
    private $db_pass = "tP1A%7qX<V#`rW0";

    public function connect() 
    {
        $dsn = "mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8";

        try {
            $pdo = new PDO($dsn, $this->db_user, $this->db_pass);

            // QUAN TRỌNG: bật lỗi để debug dễ hơn
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }
}