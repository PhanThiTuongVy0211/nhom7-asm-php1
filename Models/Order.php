<?php
// Models/AdminOrder.php
class AdminOrder
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Lấy toàn bộ danh sách đơn hàng hiển thị tại trang quản trị
    public function getAllOrders()
    {
        $sql = "SELECT * FROM orders ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xem chi tiết một đơn hàng cụ thể
    public function getOrderById($orderId)
    {
        $sql = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách sản phẩm thuộc đơn hàng đó
    public function getOrderDetails($orderId)
    {
        $sql = "SELECT od.*, p.name FROM order_details od 
                JOIN products p ON od.product_id = p.id 
                WHERE od.order_id = :order_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cập nhật trạng thái xử lý đơn hàng (Ví dụ: Đang xử lý, Đã giao, Hủy)
    public function updateStatus($orderId, $status)
    {
        $sql = "UPDATE orders SET status = :status, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['status' => $status, 'id' => $orderId]);
    }

    // Xóa đơn hàng (Nếu cần)
    public function deleteOrder($orderId)
    {
        try {
            $this->db->beginTransaction();
            // Xóa chi tiết đơn hàng trước do ràng buộc khóa ngoại
            $sqlDetail = "DELETE FROM order_details WHERE order_id = :order_id";
            $stmtDetail = $this->db->prepare($sqlDetail);
            $stmtDetail->execute(['order_id' => $orderId]);

            // Xóa đơn hàng chính
            $sqlOrder = "DELETE FROM orders WHERE id = :id";
            $stmtOrder = $this->db->prepare($sqlOrder);
            $stmtOrder->execute(['id' => $orderId]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}