<?php
// Controllers/AdminOrderController.php
require_once 'Models/Order.php';

class AdminOrderController
{
    private $adminOrderModel;

    public function __construct($pdo)
    {
        $this->adminOrderModel = new AdminOrder($pdo);
    }

    // Hiển thị danh sách toàn bộ đơn hàng
    public function index()
    {
        $orders = $this->adminOrderModel->getAllOrders();
        // Gọi tới giao diện admin quản lý đơn hàng
        require_once 'Views/admin/orders/index.php';
    }

    // Xem chi tiết đơn hàng & các sản phẩm bên trong
    public function detail()
    {
        $orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $order = $this->adminOrderModel->getOrderById($orderId);

        if ($order) {
            $orderDetails = $this->adminOrderModel->getOrderDetails($orderId);
            require_once 'Views/admin/orders/detail.php';
        } else {
            echo "Đơn hàng không tồn tại.";
        }
    }

    // Cập nhật nhanh trạng thái đơn hàng (Duyệt đơn / Giao hàng)
    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = intval($_POST['order_id']);
            $status = $_POST['status']; // Ví dụ: 'Pending', 'Processing', 'Completed', 'Cancelled'

            $this->adminOrderModel->updateStatus($orderId, $status);
            header("Location: index.php?action=admin-orders");
            exit();
        }
    }

    // Xóa đơn hàng lỗi/hủy
    public function delete()
    {
        $orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($this->adminOrderModel->deleteOrder($orderId)) {
            header("Location: index.php?action=admin-orders");
            exit();
        } else {
            echo "Không thể xóa đơn hàng này.";
        }
    }
}