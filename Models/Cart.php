<?php
// Models/Cart.php
class Cart
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Lấy danh sách sản phẩm trong giỏ từ CSDL 
    public function getCartFromDB($userId)
    {
        $sql = "SELECT c.id as cart_id, c.quantity, p.id, p.name, p.price, p.img 
                FROM cart c 
                JOIN products p ON c.product_id = p.id 
                WHERE c.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm vào CSDL giỏ hàng
    public function addToCartDB($userId, $productId, $quantity)
    {
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của user chưa
        $sqlCheck = "SELECT id, quantity FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $stmtCheck = $this->db->prepare($sqlCheck);
        $stmtCheck->execute(['user_id' => $userId, 'product_id' => $productId]);
        $row = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $newQty = $row['quantity'] + $quantity;
            $sqlUpdate = "UPDATE cart SET quantity = :quantity WHERE id = :id";
            $stmtUpdate = $this->db->prepare($sqlUpdate);
            return $stmtUpdate->execute(['quantity' => $newQty, 'id' => $row['id']]);
        } else {
            $sqlInsert = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
            $stmtInsert = $this->db->prepare($sqlInsert);
            return $stmtInsert->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
        }
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng 
    public function updateQuantityInDB($cartId, $quantity)
    {
        if ($quantity <= 0) {
            $sql = "DELETE FROM cart WHERE id = :cart_id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute(['cart_id' => $cartId]);
        } else {
            $sql = "UPDATE cart SET quantity = :quantity WHERE id = :cart_id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute(['quantity' => $quantity, 'cart_id' => $cartId]);
        }
    }

    // Xóa sạch giỏ hàng của user sau khi thanh toán xong 
    public function clearCart($userId)
    {
        $sql = "DELETE FROM cart WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['user_id' => $userId]);
    }
}