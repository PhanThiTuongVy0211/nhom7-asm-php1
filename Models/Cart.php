<?php
require_once 'Database.php';

class CartModel
{
    private $db;

    public function __construct()
    {
        // Sử dụng lớp Database tập trung để lấy cấu hình kết nối Host
        $this->db = new Database();
    }

    //  Lấy danh sách chi tiết sản phẩm từ CSDL dựa trên mảng ID truyền vào
    public function getCartProducts($productIds)
    {
        if (empty($productIds)) {
            return [];
        }

        // Chuyển mảng ID thành chuỗi an toàn (Ví dụ: 1, 2, 3)
        $ids = implode(',', array_map('intval', $productIds));

        // Thực hiện câu lệnh truy vấn qua phương thức query() của lớp Database
        $sql = "SELECT id, name, price, image FROM products WHERE id IN ($ids)";
        return $this->db->query($sql);
    }
}