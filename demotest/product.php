<?php

class Product
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    /**
     * Lay danh sach tat ca san pham bao gom ten danh muc
     * 
     * @return array
     */


    public function getAll()
    {
        $sql = "SELECT * FROM `products` JOIN `Categories` ON `Categories`.id = `products`.`category_id` WHERE `Category_id` = 1";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
