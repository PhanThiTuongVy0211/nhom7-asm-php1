<?php

class Database
{
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
  
    public $connection = null; 

    public function __construct()
    {
        $this->db_host = "103.57.220.210";
        $this->db_name = "gtpixbirhosting_lethikieunguyen";
        $this->db_user = "gtpixbirhosting_lethikieunguyen";
        $this->db_pass = "tP1A%7qX<V#`rW0";
    }

    public function getConnection() 
    {
        if ($this->connection !== null) {
            return $this->connection;
        }

        $dsn = "mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8mb4";
        try {
            $this->connection = new PDO($dsn, $this->db_user, $this->db_pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->connection;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}