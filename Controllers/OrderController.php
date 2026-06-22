<?php

class AdminOrderController
{
    private $adminOrderModel;

    // ĐÃ SỬA LỖI: Chuyển tham số thành tùy chọn ($pdo = null) để VS Code không bắt bẻ gạch đỏ
    public function __construct($pdo = null)
    {
        // ĐÃ SỬA LỖI: Thay lớp kết nối từ AdminOrder thành OrderModel cho khớp chuẩn xác với file Models/Order.php của bạn
        $this->adminOrderModel = new OrderModel();
    }

    // Hiển thị danh sách toàn bộ đơn hàng
    public function index()
    {
        $orders = $this->adminOrderModel->getAllOrders();
        // Gọi tới giao diện admin quản lý đơn hàng
        require_once 'Views/Admin.php';
    }

    // Xem chi tiết đơn hàng & các sản phẩm bên trong
    public function detail()
    {
        $orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Kiểm tra xem hàm getOrderById có tồn tại trong Model không để tránh crash code hệ thống
        if (method_exists($this->adminOrderModel, 'getOrderById')) {
            $order = $this->adminOrderModel->getOrderById($orderId);
        } else {
            $order = null;
        }

        if ($order) {
            $orderDetails = method_exists($this->adminOrderModel, 'getOrderDetails') ? $this->adminOrderModel->getOrderDetails($orderId) : [];
            require_once 'Views/pages/admin-chi-tiet-don-hang.php';
        } else {
            // Dự phòng nếu chưa có trang chi tiết riêng, hiển thị lại bảng danh sách đơn hàng
            require_once 'Views/Admin.php';
        }
    }

    // Cập nhật nhanh trạng thái đơn hàng (Duyệt đơn / Giao hàng)
    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = intval($_POST['order_id']);
            $status = $_POST['status']; // Ví dụ: 'Chờ xử lý', 'Đã thanh toán', 'Đã hủy'

            $this->adminOrderModel->updateStatus($orderId, $status);
            header("Location: index.php?pages=admin-don-hang"); // Đã sửa đường dẫn điều hướng đồng bộ với tham số cấu hình hệ thống
            exit();
        }
    }

    // Xóa đơn hàng lỗi/hủy
    public function delete()
    {
        $orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if (method_exists($this->adminOrderModel, 'deleteOrder') && $this->adminOrderModel->deleteOrder($orderId)) {
            header("Location: index.php?pages=admin-don-hang");
            exit();
        } else {
            header("Location: index.php?pages=admin-don-hang");
            exit();
        }
    }
}