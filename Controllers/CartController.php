<?php
require_once 'Models/Cart.php';
class CartController
{
    private $cartModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // SỬA TẠI ĐÂY: Phải là CartModel() chứ không phải Cart()
        $this->cartModel = new CartModel();
    }
    // [Mục 13]: Hiển thị danh sách sản phẩm trong giỏ hàng bằng Session và chuẩn bị vòng lặp
    public function index()
    {
        // Lấy mảng sản phẩm lưu từ Session (Key là ID sản phẩm, Value là số lượng)
        $cartSession = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $productIds = array_keys($cartSession);

        $cartProducts = [];
        if (!empty($productIds)) {
            // Lấy dữ liệu gốc của các sản phẩm này từ CSDL
            $productsFromDb = $this->cartModel->getCartProducts($productIds);

            // Duyệt qua danh sách để kết hợp dữ liệu CSDL với số lượng trong Session
            if (is_array($productsFromDb)) {
                foreach ($productsFromDb as $product) {
                    $productId = $product['id'];
                    // Đưa số lượng đặt mua từ Session vào mảng hiển thị công việc của Nguyên
                    $product['quantity'] = $cartSession[$productId];
                    $cartProducts[] = $product;
                }
            }
        }

        // Định vị chính xác tệp giao diện nằm trong thư mục pages của bạn để tránh lỗi mở file
        if (file_exists('Views/pages/cart.php')) {
            require_once 'Views/pages/cart.php';
        } elseif (file_exists('Views/Cart.php')) {
            require_once 'Views/Cart.php';
        } else {
            echo "<h3 style='text-align:center;color:red;margin-top:50px;'>Lỗi: Không tìm thấy file giao diện giỏ hàng (cart.php)!</h3>";
        }
    }

    // [Mục 15]: Cập nhật số lượng sản phẩm trực tiếp trong giỏ hàng
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = intval($_POST['product_id']);
            $quantity = intval($_POST['quantity']);

            if ($quantity <= 0) {
                // Nếu hạ số lượng xuống bằng hoặc nhỏ hơn 0, tiến hành xóa sản phẩm khỏi giỏ
                unset($_SESSION['cart'][$productId]);
            } else {
                // Cập nhật lại số lượng mới vào Session dữ liệu của Nguyên
                $_SESSION['cart'][$productId] = $quantity;
            }
        }
        // Sau khi xử lý xong, điều hướng quay lại trang giỏ hàng để cập nhật giao diện trực quan
        header('Location: index.php?pages=gio-hang');
        exit();
    }
}