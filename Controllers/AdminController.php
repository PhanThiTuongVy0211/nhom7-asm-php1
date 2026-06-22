<?php
// Controllers/AdminOrderController.php

class AdminOrderController
{
    private $orderModel;

    // SỬA TẠI ĐÂY: Nhận $pdo từ index.php nhưng không truyền vào OrderModel vì OrderModel tự kết nối bên trong
    public function __construct($pdo = null)
    {
        $this->orderModel = new OrderModel(); // Sửa từ AdminOrder thành OrderModel cho đúng file Models/Order.php của bạn
    }

    // Hiển thị danh sách toàn bộ đơn hàng mua đồ thời trang nữ
    public function index()
    {
        $orders = $this->orderModel->getAllOrders();
        // Gọi tới giao diện admin quản lý đơn hàng theo cấu trúc file của bạn
        require_once 'Views/Admin.php';
    }

    // Xem chi tiết đơn hàng & các sản phẩm bên trong
    public function detail()
    {
        $orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Kiểm tra xem hàm có tồn tại trong Model không để tránh crash code
        if (method_exists($this->orderModel, 'getOrderById')) {
            $order = $this->orderModel->getOrderById($orderId);
        } else {
            $order = null;
        }

        if ($order) {
            $orderDetails = method_exists($this->orderModel, 'getOrderDetails') ? $this->orderModel->getOrderDetails($orderId) : [];
            require_once 'Views/pages/admin-chi-tiet-don-hang.php';
        } else {
            // Dự phòng tạm thời nếu bạn chưa làm trang chi tiết đầy đủ dữ liệu CSDL
            require_once 'Views/Admin.php';
        }
    }

    // Cập nhật nhanh trạng thái đơn hàng (Duyệt đơn / Giao hàng / Thanh toán)
    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = intval($_POST['order_id']);
            $status = $_POST['status']; // Ví dụ: 'Chưa thanh toán', 'Đã thanh toán'

            $this->orderModel->updateStatus($orderId, $status); // Gọi hàm updateStatus chuẩn của bạn

            // Quay về đúng tham số định tuyến pages của index.php của bạn
            header("Location: index.php?pages=admin-don-hang");
            exit();
        }
    }

    // Xóa đơn hàng lỗi/hủy
    public function delete()
    {
        $orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if (method_exists($this->orderModel, 'deleteOrder') && $this->orderModel->deleteOrder($orderId)) {
            header("Location: index.php?pages=admin-don-hang");
            exit();
        } else {
            header("Location: index.php?pages=admin-don-hang");
            exit();
        }
    }
}